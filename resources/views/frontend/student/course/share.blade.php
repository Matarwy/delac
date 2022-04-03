<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">    <style>
        a {
            padding: 20px;
            font-size: 30px;
            width: 50px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fb {
            background: #3B5998;
            color: white;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-google {
            background: #dd4b39;
            color: white;
        }

        .linked {
            background: #007bb5;
            color: white;
        }

        .fa-youtube {
            background: #bb0000;
            color: white;
        }

        .fa-instagram {
            background: #125688;
            color: white;
        }

        .fa-pinterest {
            background: #cb2027;
            color: white;
        }

        .fa-snapchat-ghost {
            background: #fffc00;
            color: white;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }

        .fa-skype {
            background: #00aff0;
            color: white;
        }

        .fa-android {
            background: #a4c639;
            color: white;
        }

        .fa-dribbble {
            background: #ea4c89;
            color: white;
        }

        .fa-vimeo {
            background: #45bbff;
            color: white;
        }

        .fa-tumblr {
            background: #2c4762;
            color: white;
        }

        .fa-vine {
            background: #00b489;
            color: white;
        }

        .fa-foursquare {
            background: #45bbff;
            color: white;
        }

        .fa-stumbleupon {
            background: #eb4924;
            color: white;
        }

        .fa-flickr {
            background: #f40083;
            color: white;
        }

        .fa-yahoo {
            background: #430297;
            color: white;
        }

        .fa-soundcloud {
            background: #ff5500;
            color: white;
        }

        .fa-reddit {
            background: #ff5700;
            color: white;
        }

        .fa-rss {
            background: #ff6600;
            color: white;
        }
    </style>
</head>

<body>

    <h2>Share </h2>
    
    @if (isset($ins))
    @php
    $link=route('live.show', ['slug'=> str_replace(' ', '-', strtolower($ins->name)),'id' => $ins->id]);
    $name = $ins->name . "Is Live Now on ". env('APP_NAME');
    @endphp

    @else
    @php
    $link= route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($course->title)),'id' => $course->id]);
    $name = $course->title .'-'. env('APP_NAME');
    @endphp
    @endif
    <a href="#" onclick="shareOnFB('{{$name}}','{{ $link }}')" class="fab fa-facebook-f fb"></a>
    <a href="#" onclick="shareOntwitter('{{$name}}','{{ $link }}')" class="fab fa-twitter"></a>

    <a href="#" onclick="shareOnLinkdin('{{$name}}','{{ $link }}')" class="fab fa-linkedin-in linked"></a>

    <a href="#" onclick="shareOnEmail('{{$name}}','{{ $link }}')" class="fa fa-envelope"></a>
    <a href="#" onclick="shareOnPin('{{$name}}','{{ $link }}')" class="fab fa-pinterest"></a>
    <a href="#" onclick="shareOnRedit('{{$name}}','{{ $link }}')" class="fab fa-reddit"></a>


</body>
<script>
    "use strict";
    function shareOntwitter(name, link) {
    var url = `https://twitter.com/intent/tweet?url=${link}&via=${name}&text=${name}`;
    TwitterWindow = window.open(url, 'TwitterWindow', width = 600, height = 300);
    return false;
    }
    
    function shareOnFB(name, link) {
    var url = `https://www.facebook.com/sharer/sharer.php?u=${link}&t=${name}`;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
    
    function shareOnPin(name, link) {
    
    
    var url = `https://in.pinterest.com/pin/create/button/?url=${link}&description=${name}`;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
    
    function shareOnRedit(name, link) {
    
    var url = `https://www.reddit.com/submit?url=${link}`;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
    
    function shareOnLinkdin(name, link) {
    
    var url = `https://www.linkedin.com/shareArticle?mini=true&summary=${name}&title=${name}&url=${link}`;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
    
    function shareOnEmail(name, link) {
    var url = `mailto:?subject=${name}&amp;body=${link}`;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
    
    function shareQR(name, link) {
    var url = link;
    window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
    }
</script>

</html>