<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
    margin : 0;
    padding : 0;
}
body{
    position: absolute;
    flex-direction: row;
    flex-wrap: wrap;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #d8d8d8;
    background-size: cover;
}
.container{
    background:black;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 550px;
    transition: opacity 1s ease-in-out;
}
.container h1{
    animation-name: slide_in;
    animation-duration: 1s;
    color : white;
    padding : 10px;
    margin : 20px;
    font-size: 90px;
}
@keyframes fade_in {
    from {opacity: 0;}
    to {opacity: 1;}
}
@keyframes slide_in {
    from {transform:translateX(-100%); }
    to {transform:translateX(0);}
}
.content {
    width: 50%; 
    text-align: center;
}

.image {
    width: 45%; 
    margin: 60px;
    position: absolute; 
    top: 10; 
    right: 0; 
    animation-name: fade_in;
    animation-duration: 1s;
}

image:hover{
    transform: scale(40.40);
}
.container p{
    animation-name:slide_in ;
    animation-duration: 1s;
    padding : 10px;
    border-radius: 20px;
    margin-left: auto;
    margin-right: auto;
    width: 500px;
    color : white;
    margin-left: auto;
    margin-right: auto;
}
.container span{
    color : red;
}
.content{
    background: transparent;
}
.content h2{
    font-size: 35px;
    color: white;
    margin : 10px;
}
.content span{
    color : red;
}
.navbar p{
    font-size: x-small;
    color : white;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding : 1.4rem 7%;
    background : rgb(30, 30, 36);
}
.navbar .nav-content a{
    width : 100px auto;
    color : white;
    display: inline-block;
    padding : 1.4rem;   
    text-decoration: none;
    font-weight: bold;
}
.navbar .nav-content a:hover{
    color : hsl(9, 90%, 49%);
    border-radius: 20px;
    transition-duration: 1s;
    transition-timing-function: linear;
}
.navbar .logo{
    color : white;
    font-size: 2rem;
    font-weight: bold;
    text-decoration: none;
}
.navbar .logo span{
    color: hsl(1, 81%, 46%);
}
.navbar .logo:hover{
    text-decoration: underline;
    transition-duration: 1s;
    transition-timing-function: linear;
}
.cards-container {
    gap: 9px;
    padding : 10px;
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}
.card p{
    padding : 20px;
}
.card {
    width: 200px;
    border-radius: 8px;
    background: #e0e0e0;
    box-shadow: inset 6px 6px 12px #c1c1c1,
                inset -6px -6px 12px #ffffff;
    padding: 20px;
    margin: 20px auto;
    text-align: center;
}

.card h2 {
    color: #333;
    padding : 10px;
}

.card p {
    color: #666;
}
.card:hover {
    transform: scale(1.1);
    background: linear-gradient(145deg, #cacaca, #f0f0f0);
    box-shadow:  6px 6px 12px #c1c1c1,
             -6px -6px 12px #ffffff;
    transition-duration: 1s;
    transition-timing-function: start;
}

.footer {
        background-color: #060606;
        color: #fff;
        padding: 20px;
        text-align: center;
        width: 100%;
        
}

footer p{
    font-size: 200px;
    color : white;
    padding: 5px;
}
footer .footer-content{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
}
.footer-content h1{
    font-family: sans-serif;
    font-size: xx-large;
    padding : 10px;
}
.footer-content p{
    font-size: small;
    font-weight: lighter;
}
aside{
    padding : 10px;
}

@media only screen and (min-width: 601px) and (max-width: 1024px) {
    .container {
        height: 450px; 
    }
    .container h1 {
        font-size: 70px; 
    }
    .navbar {
        padding: 1rem 5%; 
    }
    .navbar .nav-content a {
        padding: 1rem; 
    }
    .cards-container {
        flex-direction: row; 
        flex-wrap: wrap; 
    }
    .card {
        width: 45%; 
    }
}
@media only screen and (min-width: 1025px) {
    .container {
        height: 600px; 
    }
    .container h1 {
        font-size: 100px; 
    }
    .navbar {
        padding: 1.4rem 10%; 
    }

    .navbar .nav-content a {
        padding: 1.4rem; 
    }

    .cards-container {
        justify-content: space-between; 
    }

    .card {
        width: 30%; 
    }
}
@keyframes slide_out {
    from {transform: translateY(-100%);}
    to {transform:translateX(0);}
}
    </style>
</head>
<body>
    <nav class = "navbar">
        <a href="#" class = "logo">Net<span>Mouse<p>Securing The Internet</p></span></a>
        <div class="nav-content">
            <a href="{{ route('index') }}">Kembali</a> 
            <a href="{{ route('team') }}">Tim</a> 
            <a href="{{ route('register') }}">Masuk</a> 
            
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <h1>Net<span>Mouse</span></h1>
            <p>Kami membantu anda dalam mencari cela yang ada di dalam website anda,
                kami juga menyediakan edukasi bagi orang awam tentang pentingya kewaspadaan dalam dunia keamanan digital.
            </p>
        </div>
       
    </div>
    </div>
    <div class="cards-container">
        <div class="card">
            <img src="{{ asset('images/secure.png') }}" alt="" width="40px" height="40px">
            <h2>Cepat Dan Aman</h2>
            <p>Kita selalu menjaga privasi anda.</p>
        </div>
        <div class="card">
        <img src="{{ asset('images/easy.png') }}" alt="" width="40px" height="40px">
            <h2>Mudah Digunakan</h2>
            <p>Kami juga menyediakan alat yang mudah untuk digunakan bagi pemula sampai lanjutan.

            </p>
        </div>
        
        <div class="card">
            <img src="{{ asset('images/open-book-hand-pointing-icon.png') }}" alt="" width="40px" height="40px">
            <h2>Edukasi Cyber</h2>
            <p>Selain memberikan layanan keamanan kita juga memberikan edukasi pada semua orang tentang bagaimana cara
                menghindari serangan cyber.
        </div>
    </div>
    <footer class="footer">
        <div class="footer-content">
            <h1>NetMouse<h1>
            <p>www.NetMouse.com
            </p>
            <p>+62 822-7706-6861 (Fiona)</p>
            <p>+62 811-3040-902 (Alegrarsio)</p>
            <aside>
                <p>&copy; 2024 NetMouse. All rights reserved.</p>
            </aside>
        </div>
    </footer>
    <script>
    </script>
</div>
</body>
</html>