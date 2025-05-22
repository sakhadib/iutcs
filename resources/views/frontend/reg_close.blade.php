@extends('layouts.main')
@section('main')

    <div class="overlay-text text-center">Presented by <span>IUT Computer Society</span></div>
    <div class="text-center">
        <h1 class="glow">🚫 Registration Closed</h1>
        <p class="subtitle">Thank you for your interest. We'll see you in the next adventure!</p>
        <a href="/" class="btn btn-tech">Go Home</a>
    </div>


    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            font-family: 'Share Tech Mono', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .glow {
            font-size: 3rem;
            color: #00ffc3;
            text-shadow: 0 0 5px #00ffc3, 0 0 10px #00ffc3, 0 0 20px #00ffc3, 0 0 40px #0ff;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #d1f7ff;
            margin-bottom: 30px;
        }

        .btn-tech {
            background: #00ffc3;
            color: #000;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 30px;
            box-shadow: 0 0 15px rgba(0, 255, 195, 0.4);
            transition: 0.3s;
        }

        .btn-tech:hover {
            background: #0ff;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.8);
            color: #000;
        }

        .overlay-text {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 1rem;
            color: #9aefff;
        }

        .overlay-text span {
            color: #00ffc3;
        }
    </style>    

@endsection