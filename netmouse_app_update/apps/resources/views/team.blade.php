<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="team.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
    margin : 0;
    padding : 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #c8c8c8;
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
    animation: slide_in;
    animation-duration: 1s;
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
    animation: slide_out;
    animation-duration: 1s;
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
        width: 20%; 
    }
}
@keyframes slide_in {
    from {transform:translateX(-100%); }
    to {transform:translateX(0);}
}
@keyframes slide_out {
    from {transform: translateY(-25%);}
    to {transform:translateX(0);}
}
.image-ale{
    background:url(asset/mountain.jpg) ;
    height: 200px;
    border-radius: 20px;
}
.image-ale img{
    margin : 20px;
}
.image-fio{
    background:url(asset/mountains-7508116_640.jpg) ;
    height: 200px;
    border-radius: 20px;
}
.image-fio img{
    margin : 20px;
}
.image-aqsa{
    background:url(asset/nyc.jpg) ;
    height: 200px;
    border-radius: 20px;
}
.image-aqsa img{
    margin : 20px;
}

    </style>
</head>
<body>
    <nav class = "navbar">
        <a href="#" class = "logo">Net<span>Team<p>We Securing The Internet</p></span></a>
        <div class="nav-content">
            <a href="{{ route('index') }}" id = "back-link">Kembali</a> 
            <a href="{{ route('register') }}">Masuk</a> 
        </div>
    </nav>
   
    <div class="cards-container">
        <div class="card">
        
            <div class="image-ale">
                <img src="{{ asset('images/DSC01778-01.jpeg') }}" alt="" width="150px" height="150px" style="border-radius: 50%;" >
            </div>
            <h2>Alegrarsio Gifta</h2>
            <p>Alegrarsio adalah seorang developer dan perekayasa dari software Netmouse.</p>
        </div>
        <div class="card">
            <div class="image-fio">
                <img src="{{ asset('images/Fio.jpeg') }}" alt="" width="150px" height="150px" style="border-radius: 50%;" >
            </div>
            <h2>Fiona Siregar</h2>
            <p>Fiona adalah penata dokumen dan desainer dari logo NetMouse.</p>
        </div>
        <div class="card">
            <div class="image-aqsa">
                <img src="{{ asset('images/aqsa.jpeg') }}" alt="" width="150px" height="155px" style="border-radius: 50%;" >
            </div>
            <h2>Fayyaz Aqsa</h2>
            <p>M Fayyaz Aqsa adalah frontend dan orang yang bertanggung jawab di fitur cyber education dari software NetMouse.</p>
        </div>
       
</body>
</html>