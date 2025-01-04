<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CTFController extends Controller
{
    public function index()
    {
        $completedChallenges = session('completed_challenges', []);

        $challenges = [
            [
                'key' => 'encryption',
                'title' => 'Hello world',
                'description' => 'Decrypt the encrypted text to find the flag.',
                'url' => route('ctf.encryption'),
            ],
            [
                'key' => 'lfi',
                'title' => 'Where is my password',
                'description' => 'Find the hidden flag by viewing the page source.',
                'url' => route('ctf.lfi'),
            ],
            [
                'key' => 'directory_traversal',
                'title' => 'Directory Traversal Challenge',
                'description' => 'Find the hidden flag by providing the correct file path.',
                'url' => route('ctf.directory_traversal'),
            ],
            [
                'key' => 'os_challenge',
                'title' => 'What is my operating system',
                'description' => 'Find the OS name and version in vulnweb.com',
                'url' => route('ctf.os_challenge'),
            ],
            [
                'key' => 'secret_page',
                'title' => 'Secret Page',
                'description' => 'Find the flag in the secret page',
                'url' => route('ctf.secret_page'),
            ],
        ];

        return view('ctf.index', compact('challenges', 'completedChallenges'));
    }

    public function encryption()
    {
        $encryptedText = 'ifmmp xpsme'; 
        return view('ctf.encryption', compact('encryptedText'));
    }

    public function checkEncryptionFlag(Request $request)
    {
        $flag = 'hello world';
        $userInput = $request->input('flag');

        if ($userInput === $flag) {
            $this->markChallengeCompleted('encryption');
            return redirect()->route('ctf.encryption')->with('success', 'Congratulations! You found the flag.');
        }

        return redirect()->route('ctf.encryption')->with('error', 'Incorrect flag. Try again!');
    }

    public function lfi()
    {
        $encryptedText = $this->encrypt('passwordku', 5); 
        $flag = 'CTF{' . $this->decrypt($encryptedText, 5) . '}';
        return view('ctf.lfi', compact('encryptedText', 'flag'));
    }

    public function submitLFI(Request $request)
    {
        $correctFlag = 'passwordku'; 
        $submittedFlag = $request->input('flag');

        if ($submittedFlag === $correctFlag) {
            $this->markChallengeCompleted('lfi');
            return back()->with('success', 'Correct! You have solved the challenge!');
        }

        return back()->with('error', 'Incorrect flag. Please try again.');
    }

    public function directoryTraversal()
    {
        return view('ctf.directory_traversal');
    }

    public function checkDirectoryTraversal(Request $request)
    {
        $correctFlag = 'flag_in_file.txt'; 
        $filePath = $request->input('file_path');
        $fileContent = '';

        if (strpos($filePath, '..') !== false) {
            return back()->with('error', 'Path traversal detected. Invalid path!');
        }

        $validFilePath = storage_path('flags/' . $correctFlag);

        if (file_exists($validFilePath) && basename($filePath) === $correctFlag) {
            $fileContent = file_get_contents($validFilePath);
            if ($fileContent === 'CTF{directory_traversal_flag}') {
                $this->markChallengeCompleted('directory_traversal');
                return back()->with('success', 'Congratulations! You found the flag.');
            }
        }

        return back()->with('error', 'Incorrect file or flag. Try again.');
    }

    public function osChallenge()
    {
        return view('ctf.os_challenge');
    }

    public function checkOSFlag(Request $request)
    {
        $correctFlag = 'Linux 2.6.32';
        $submittedFlag = $request->input('os_flag');

        if ($submittedFlag === $correctFlag) {
            $this->markChallengeCompleted('os_challenge');
            return redirect()->route('ctf.os_challenge')->with('success', 'Congratulations! You found the flag.');
        }

        return redirect()->route('ctf.os_challenge')->with('error', 'Incorrect flag. Try again!');
    }

    public function secretPage()
{
    
    $plainText = 'hello world from netmouse';


    $encryptedText = base64_encode($plainText);

   
    return view('ctf.secret_page', compact('encryptedText'));
}

    public function submitSecretPageFlag(Request $request)
{

    $correctPlainText = 'hello world from netmouse';

    
    $submittedFlag = $request->input('flag');

    $submittedFlag = trim($submittedFlag);

    
    if ($submittedFlag === $correctPlainText) {
        $this->markChallengeCompleted('secret_page');
        return redirect()->route('ctf.secret_page')->with('success', 'Congratulations! You found the flag.');
    }

    return redirect()->route('ctf.secret_page')->with('error', 'Incorrect flag. Try again!');
}

    private function encrypt($text, $shift)
    {
        $result = '';
        $text = strtolower($text);
        
        foreach (str_split($text) as $char) {
            if (ctype_alpha($char)) {
                $ascii = ord($char);
                $shifted = (($ascii - 97 + $shift) % 26) + 97;
                $result .= chr($shifted);
            } else {
                $result .= $char; 
            }
        }

        return $result;
    }

    private function decrypt($text, $shift)
    {
        $result = '';
        $text = strtolower($text);

        foreach (str_split($text) as $char) {
            if (ctype_alpha($char)) {
                $ascii = ord($char);
                $shifted = (($ascii - 97 - $shift + 26) % 26) + 97;
                $result .= chr($shifted);
            } else {
                $result .= $char;
            }
        }

        return $result;
    }

    private function markChallengeCompleted($key)
    {
        $completedChallenges = session('completed_challenges', []);
        if (!in_array($key, $completedChallenges)) {
            $completedChallenges[] = $key;
            session(['completed_challenges' => $completedChallenges]);
        }
    }

    public function resetChallenges()
    {
        session()->forget('completed_challenges');
        return redirect()->route('ctf.index')->with('success', 'Challenges reset successfully.');
    }
}
