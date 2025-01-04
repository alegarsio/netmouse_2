<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetMouse</title>

    <style>
        *{
    margin : 0;
    padding : 0;
    
}
body{
    font-family: Arial, Helvetica, sans-serif;
    background : black;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: cover;
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
    background : transparent;
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
.main-content{
    width : 100%;
    position: absolute;
    top : 50%;
    transform: translateY(-50%);
    text-align: center;
    color: white;
    transition: opacity 1s ease-in-out;
}
.main-content p{
    padding : 10px;
    width: 700px;
    animation-name:fade_in ;
    animation-duration: 1s;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

.main-content h1{
    font-size: 100px;
    animation-name:slide_out ;
    animation-duration: 1s;
}
@keyframes fade_in {
    from {opacity: 0;}
    to {opacity: 1;}
}
.main-content h1 span{
    color: rgb(255, 34, 0);
}
button{
    width: 200px;
    padding : 15px 0;
    text-align:center;
    margin : 20px 10px;
    border-radius: 20px;
    background-color: rgb(57, 59, 59);
    color : white;
    border: none;
}
button a{
    text-decoration: none;
    color : white;
    font-weight: bold ;
}

button :hover{
    color :rgb(255, 145, 0);
    transition-duration: 0.9s;
    transition-timing-function: linear;
}
.profile-icon{
    color : white;
}
footer {
        background:transparent;
        padding: 20px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
}

footer p{
    color : white;
}
@keyframes slide_out {
    from {transform: translateY(-100%);}
    to {transform:translateX(0);}
}


@media only screen and (max-width: 600px) {
    .navbar {
        padding: 1rem; 
    }

    .navbar .nav-content a {
        padding: 0.8rem; 
    }

    .main-content h1 {
        font-size: 2.5rem;
    }

    button {
        width: 150px; 
        padding: 8px 16px; 
    }
}
    </style>
</head>
<body>
    <nav class = "navbar">
        <a href="#" class = "logo">Net<span>Mouse<p>Securing The Internet</p></span></a>
        <div class="nav-content">
            <a href="{{ route('about') }}" id="about-link">Tentang</a><span><i class="fa-solid fa-user-group"></i></span> 
            <a href="{{ route('register') }}">Masuk</a> 
        </div>
    </nav>
    <div class="main-content">
        <h1>Net<span>Mouse</span></h1>
        <p>NetMouse adalah website yang menyediakan layanan keamanan
            pada website, kita juga memberikan edukasi 
            bagi orang awam tentang bagaiamana cara menghindari serangan cyber.
        </p>
        <div>
            <button type = "button" ><a href = "#">Coba Demo</a></button>
            <button type = "button" ><a href = "https://github.com/alegarsio">Repositori</a></button>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 NetMouse. All rights reserved.</p>
    </footer>
    <script>
        document.getElementById("about-link").addEventListener("click", function(event) {
            event.preventDefault(); 
            document.querySelector(".main-content").style.opacity = "0";
            setTimeout(function() {
                window.location.href = event.target.href;
    }, 1000); });
    </script>
</body>
</html>
