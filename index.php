<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio Tatuador | Nome do Artista</title>
    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary-color: #009c3b;
            --secondary-color: #1a1a1a;
            --dark-gray: #333333;
            --medium-gray: #555555;
            --light-gray: #aaaaaa;
            --text-color: #f0f0f0;
            --font-heading: 'Oswald', sans-serif;
            --font-body: 'Lato', sans-serif;
            --overlay-color: rgba(0, 0, 0, 0.9);
            /* --- SPEEDS --- */
            --scroll-speed-slow: 1.2;
            --scroll-speed-fast: 4.8;
            --scroll-speed-very-fast: 9.6;
            /* --- END SPEEDS --- */
            --column-gap: 1.5rem;
            --image-gap: 1.5rem;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html {}
        body { font-family: var(--font-body); background-color: var(--secondary-color); color: var(--text-color); line-height: 1.6; overflow-x: hidden; background-image: url('https://images.unsplash.com/photo-1504198266287-1659872e6ae7?auto=format&fit=crop&q=80&w=1974'); background-size: cover; background-position: center center; background-attachment: fixed; }
        body.lightbox-open { overflow-y: hidden; }
        h1, h2, h3, h4, h5, h6 { font-family: var(--font-heading); color: var(--primary-color); margin-bottom: 1rem; line-height: 1.2; text-transform: uppercase; letter-spacing: 1px; }
        #stage1 { height: 100vh; min-height: 600px; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; position: relative; opacity: 0; transition: opacity 1s ease-in-out; padding: 25px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)); }
        #stage1.visible { opacity: 1; }

        /* --- Stage 1 Logo Container - Positioning wrapper --- */
        .logo-container-stage1 {
            width: auto; height: auto; margin-bottom: 2.5rem; position: relative;
            transform: translateY(25px); opacity: 0;
            transition: opacity 0.8s ease-out 0.2s, transform 0.8s ease-out 0.2s;
        }
        #stage1.visible .logo-container-stage1 { opacity: 1; transform: translateY(0); }

        /* --- Stage 1 Logo Image - Sized explicitly --- */
        .logo-container-stage1 .logo-image-stage1 {
            display: block; width: 600px; height: 600px; max-width: 90vw; max-height: 70vh;
            object-fit: contain; content: url('/images/logo.PNG'); /* YOUR LOGO PATH */
            /* NEW: Drop Shadow */
            filter: drop-shadow(4px 6px 10px rgba(0,0,0,0.5));
        }

        /* --- Stage 1 Artist Overlay --- */
        .artist-photo-overlay {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); /* Centered */
            width: 85%; /* Adjusted percentage */ height: 85%; /* Adjusted percentage */ z-index: 5;
        }
        .artist-photo-overlay img {
            width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(3px 5px 8px rgba(0,0,0,0.5));
            content: url('/images/artist.PNG'); /* YOUR ARTIST PATH */
        }

        .artist-description-stage1 { font-size: 1.2rem; color: var(--text-color); max-width: 700px; margin-bottom: 3rem; line-height: 1.8; transform: translateY(25px); opacity: 0; transition: opacity 0.8s ease-out 0.4s, transform 0.8s ease-out 0.4s; }
        #stage1.visible .artist-description-stage1 { opacity: 1; transform: translateY(0); }
        #see-work-btn { padding: 15px 40px; background-color: var(--primary-color); color: #fff; border: none; font-family: var(--font-heading); font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease, transform 0.2s ease, opacity 0.8s ease-out 0.6s, transform 0.8s ease-out 0.6s; transform: translateY(25px); opacity: 0; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4); }
        #stage1.visible #see-work-btn { opacity: 1; transform: translateY(0); }
        #see-work-btn:hover { background-color: #007f30; transform: translateY(-3px); }
        #stage2 { min-height: 100vh; width: 100%; position: relative; padding-top: 80px; padding-bottom: 150px; z-index: 10; display: none; }
        #top-logo, #scroll-controls, #info-bar, #reset-gallery-btn { opacity: 0; visibility: hidden; transition: opacity 0.5s ease-in-out, visibility 0s linear 0.5s; position: fixed; z-index: 100; }
        #stage2.visible #top-logo, #stage2.visible #scroll-controls, #stage2.visible #info-bar { opacity: 1; visibility: visible; transition: opacity 0.5s ease-in-out 0.3s; }

        /* --- Top Logo Container - Invisible positioning element --- */
        #top-logo {
            top: 15px; left: 50%; transform: translateX(-50%); position: fixed;
            z-index: 100; cursor: pointer; width: auto; height: auto;
            transition: transform 0.2s ease;
        }
         #top-logo:hover { transform: translateX(-50%) scale(1.1); }

        /* --- Top Logo Image - Sized directly --- */
        #top-logo img {
            display: block; width: 200px; height: 200px;
            object-fit: contain; content: url('/images/logo.PNG'); /* YOUR LOGO PATH */
            /* NEW: Drop Shadow */
            filter: drop-shadow(1px 2px 3px rgba(0,0,0,0.4));
        }

        #gallery-container { display: flex; justify-content: center; gap: var(--column-gap); width: 100%; position: relative; padding: 0 20px; min-height: 50vh; }
        .gallery-column { display: flex; flex-direction: column; width: 300px; will-change: transform; transition: transform 0.6s ease-out; }
        .gallery-image { width: 100%; height: auto; margin-bottom: var(--image-gap); border: 4px solid var(--dark-gray); cursor: pointer; transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, border-color 0.2s ease-out; background-color: var(--dark-gray); }
        .gallery-image:hover { transform: scale(1.03); box-shadow: 0 0 18px rgba(0, 0, 0, 0.4); border-color: var(--primary-color); z-index: 10; }
        #scroll-controls { bottom: 85px; right: 20px; background-color: rgba(26, 26, 26, 0.85); padding: 0.6rem; border-radius: 5px; display: flex; gap: 0.6rem; border: 1px solid var(--dark-gray); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4); }
        #scroll-controls button { background-color: var(--dark-gray); border: 1px solid var(--medium-gray); color: var(--light-gray); font-size: 1.3rem; padding: 0.5rem 0.7rem; cursor: pointer; border-radius: 3px; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, transform 0.2s ease; min-width: 48px; display: flex; align-items: center; justify-content: center; }
        #scroll-controls button:hover { background-color: var(--medium-gray); border-color: var(--primary-color); color: #fff; transform: translateY(-2px); }
        #scroll-controls button.active { background-color: var(--primary-color); color: #fff; border-color: var(--primary-color); font-weight: bold; }
        #scroll-controls button.active i, #scroll-controls button:hover i { color: #fff; }
        #scroll-controls button i { color: var(--primary-color); transition: color 0.3s ease; }

        /* Info Bar - Base Styling */
        #info-bar { bottom: 0; left: 0; width: 100%; background-color: rgba(10, 10, 10, 0.9); padding: 1.2rem 1.5rem; text-align: center; font-size: 1.2rem; border-top: 2px solid var(--primary-color); display: flex; justify-content: center; align-items: center; gap: 1.5rem; flex-wrap: wrap; }
         /* Info Bar - Clickable Address */
         #info-bar #address-link { color: var(--light-gray); font-size: 1.3rem; flex-shrink: 0; cursor: pointer; transition: color 0.3s ease; display: inline-flex; align-items: center; gap: 0.5em; }
         #info-bar #address-link:hover { color: var(--primary-color); }
         #info-bar #address-link i { color: var(--primary-color); margin-right: 0.3em; font-size: 1.1em; /* Slightly larger icon */}
         /* Info Bar - Social Links */
        #info-bar a { color: var(--text-color); text-decoration: none; transition: color 0.3s ease, transform 0.3s ease; display: inline-flex; align-items: center; gap: 0.5em; font-size: 1.2rem; }
        #info-bar a:hover { color: var(--primary-color); transform: scale(1.05); }
        #info-bar a i { font-size: 2.0rem; vertical-align: middle; }
        #info-bar a .info-bar-label { font-size: 1.1rem; font-family: var(--font-body); font-weight: 400; color: var(--light-gray); line-height: 1.2; transition: color 0.3s ease; }
        #info-bar a:hover .info-bar-label { color: var(--primary-color); }

        #reset-gallery-btn { position: fixed; bottom: 85px; left: 50%; transform: translateX(-50%); padding: 10px 20px; background-color: var(--primary-color); color: #fff; border: none; font-family: var(--font-heading); font-size: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; border-radius: 5px; z-index: 99; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); opacity: 0; visibility: hidden; display: none; transition: opacity 0.4s ease, visibility 0s linear 0.4s, bottom 0.3s ease; }
        #reset-gallery-btn.visible { display: inline-flex; align-items: center; gap: 0.5em; opacity: 1; visibility: visible; transition: opacity 0.4s ease, visibility 0s linear 0s, bottom 0.3s ease; }
        #reset-gallery-btn:hover { background-color: #007f30; transform: translateX(-50%) translateY(-2px); }
        #reset-countdown { font-size: 0.9em; font-weight: normal; opacity: 0.8; display: inline-block; }

        /* Image Lightbox Styles (Unchanged) */
        #lightbox { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: var(--overlay-color); display: flex; align-items: center; justify-content: center; z-index: 200; opacity: 0; visibility: hidden; transition: opacity 0.4s ease, visibility 0s linear 0.4s; padding: 1vh 1vw; }
        #lightbox.visible { opacity: 1; visibility: visible; transition: opacity 0.4s ease; }
         #lightbox-content { position: relative; max-width: 96vw; max-height: 88vh; width: 96vw; height: 88vh; box-shadow: 0 10px 30px rgba(0,0,0,0.5); background-image: none; background-size: contain; background-repeat: no-repeat; background-position: center center; }
        #lightbox-close { position: absolute; top: -10px; right: -15px; z-index: 210; font-size: 2.2rem; font-weight: bold; color: var(--text-color); background-color: rgba(0, 0, 0, 0.5); border: none; border-radius: 50%; line-height: 1; padding: 0.1em 0.4em; cursor: pointer; transition: transform 0.2s ease, color 0.2s ease, background-color 0.2s ease; text-shadow: none; }
         #lightbox-close:hover { transform: scale(1.15); color: var(--primary-color); background-color: rgba(0, 0, 0, 0.75); }

        /* --- NEW: Address Lightbox Styles --- */
        #address-lightbox { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: var(--overlay-color); display: flex; align-items: center; justify-content: center; z-index: 200; opacity: 0; visibility: hidden; transition: opacity 0.4s ease, visibility 0s linear 0.4s; padding: 3vh 2vw; }
        #address-lightbox.visible { opacity: 1; visibility: visible; transition: opacity 0.4s ease; }
        #address-lightbox-content { position: relative; background-color: var(--secondary-color); padding: 2rem 2.5rem; border-radius: 8px; border: 1px solid var(--dark-gray); max-width: 700px; width: 90%; max-height: 90vh; overflow-y: auto; text-align: center; box-shadow: 0 5px 25px rgba(0,0,0,0.6); }
        #address-lightbox-close { position: absolute; top: 10px; right: 15px; z-index: 215; font-size: 2rem; font-weight: bold; color: var(--text-color); background: none; border: none; cursor: pointer; transition: transform 0.2s ease, color 0.2s ease; padding: 0; line-height: 1; }
        #address-lightbox-close:hover { transform: scale(1.2); color: var(--primary-color); }
        #address-lightbox #studio-image { display: block; max-width: 100%; height: auto; max-height: 40vh; margin: 0 auto 1.5rem auto; border: 1px solid var(--dark-gray); object-fit: cover; }
        #address-lightbox #studio-description { font-size: 1.1rem; color: var(--text-color); line-height: 1.7; margin-bottom: 2rem; text-align: left; }
        #address-lightbox #map-link { display: inline-flex; align-items: center; gap: 0.6em; padding: 12px 25px; background-color: var(--primary-color); color: #fff; border: none; font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease, transform 0.2s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); }
        #address-lightbox #map-link:hover { background-color: #007f30; transform: translateY(-2px); }
         #address-lightbox #map-link i { font-size: 1.3em; }
        /* --- END Address Lightbox Styles --- */


        /* Responsive adjustments */
        @media (max-width: 992px) {
             .logo-container-stage1 .logo-image-stage1 { width: 420px; height: 420px; }
             .artist-description-stage1 { max-width: 600px; font-size: 1.1rem;}
             #see-work-btn { padding: 12px 35px; font-size: 1.1rem;}
             #info-bar { font-size: 1.1rem; gap: 1.5rem;}
             #info-bar #address-link { font-size: 1.2rem; } /* Adjust address size */
             #info-bar a { font-size: 1.1rem; } #info-bar a i { font-size: 1.8rem; } #info-bar a .info-bar-label { font-size: 1.0rem; }
             /* #top-logo img { width: 70px; height: 70px; } */
        }
        @media (max-width: 768px) {
            .logo-container-stage1 .logo-image-stage1 { width: 360px; height: 360px; }
            .artist-photo-overlay { width: 80%; height: 80%; }
            .gallery-column { width: 70%; } #gallery-container { padding-left: 15%; padding-right: 15%; gap: 0; }
             /* Increased bottom offset for controls/reset button */
            #scroll-controls { right: 10px; bottom: 130px; flex-wrap: wrap; justify-content: flex-end; gap: 0.5rem; }
            #reset-gallery-btn { font-size: 0.9rem; padding: 8px 15px; bottom: 130px; }
            #scroll-controls button { min-width: 45px; padding: 0.5rem 0.6rem; }
            #info-bar { font-size: 1rem; padding: 1rem; gap: 1rem;}
            #info-bar #address-link { font-size: 1.1rem; }
            #info-bar span { font-size: 1.1rem; } /* Original span style for address icon */
            #info-bar a { font-size: 1rem; } #info-bar a i { font-size: 1.6rem; } #info-bar a .info-bar-label { font-size: 0.9rem; }
            .artist-description-stage1 { max-width: 90%; font-size: 1rem;} #see-work-btn { padding: 10px 30px; font-size: 1rem;}
            #lightbox-close { font-size: 2rem; top: 0px; right: 0px;}
            #top-logo img { width: 65px; height: 65px; }
        }
        @media (max-width: 480px) {
             .logo-container-stage1 .logo-image-stage1 { width: 300px; height: 300px; }
             .artist-photo-overlay { width: 75%; height: 75%; }
             .gallery-column { width: 90%; } #gallery-container { padding-left: 5%; padding-right: 5%; } #stage2 { padding-top: 70px; padding-bottom: 140px; }
              /* Increased bottom offset more for smallest screens */
             #scroll-controls { right: 5px; bottom: 145px; padding: 0.4rem; gap: 0.4rem; }
             #reset-gallery-btn { font-size: 0.8rem; padding: 8px 12px; bottom: 145px; left: auto; right: 5px; transform: translateX(0); gap: 0.4em;}
             #scroll-controls button { font-size: 1.1rem; padding: 0.4rem 0.5rem; min-width: 40px;}
             #info-bar { flex-direction: column; padding: 1rem; gap: 1rem; } /* Added padding, increased gap */
             #info-bar #address-link { font-size: 1rem; }
             #info-bar span { font-size: 1rem; } /* Original span style */
             #info-bar a { font-size: 1rem; } #info-bar a i { font-size: 1.6rem; } #info-bar a .info-bar-label { font-size: 0.9rem; }
             .artist-description-stage1 { font-size: 0.9rem; } #see-work-btn { padding: 10px 25px; font-size: 0.9rem; }
             #reset-countdown { font-size: 0.8em;} #lightbox-close { font-size: 1.8rem; top: 2px; right: 2px;}
             #top-logo img { width: 55px; height: 55px; }
        }
    </style>

<?php
    // --- PHP Configuration ---
    $imageFolderPathServer = __DIR__ . '/images/tattoos'; // MODIFY IF NEEDED
    $imageFolderPathWeb = '/images/tattoos'; // MODIFY IF NEEDED
    // --- End Configuration ---

    $tattooImageUrlsPHP = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];

    if (is_dir($imageFolderPathServer) && is_readable($imageFolderPathServer)) {
        $files = scandir($imageFolderPathServer);
        if ($files !== false) {
            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || strpos($file, '.') === 0) continue;
                $filePathServer = $imageFolderPathServer . '/' . $file;
                if (is_file($filePathServer)) {
                    $fileInfo = pathinfo($filePathServer);
                    $extension = isset($fileInfo['extension']) ? strtolower($fileInfo['extension']) : '';
                    if (in_array($extension, $allowedExtensions)) {
                        $tattooImageUrlsPHP[] = $imageFolderPathWeb . '/' . $file;
                    }
                }
            }
            sort($tattooImageUrlsPHP);
        } else { error_log("PHP Portfolio: Could not scan directory: " . $imageFolderPathServer); }
    } else { error_log("PHP Portfolio: Image directory not found or not readable: " . $imageFolderPathServer); }
?>

    <!-- Inject PHP array into JavaScript -->
    <script>
        const tattooImageUrls = <?php echo json_encode($tattooImageUrlsPHP); ?>;
        console.log('Tattoo URLs loaded via PHP:', tattooImageUrls);
    </script>

</head>
<body>
    <!-- Stage 1: Intro (Structure Unchanged) -->
    <section id="stage1">
         <div class="logo-container-stage1">
             <img class="logo-image-stage1" alt="Logo">
              <div class="artist-photo-overlay">
                  <img src="/images/artist.PNG" alt="Foto do Artista"> <!-- Updated path -->
               </div>
         </div>
         <p class="artist-description-stage1"> Bem-vindo ao meu estúdio... Aqui você encontra paixão, arte e tinta. Explore meus trabalhos e entre em contato para criar sua próxima obra-prima na pele. </p>
         <button id="see-work-btn">Ver Meu Trabalho</button>
    </section>

    <!-- Stage 2: Gallery (Structure Unchanged) -->
    <section id="stage2" style="display: none;">
        <div id="top-logo" title="Voltar ao Topo">
            <img alt="Logo Pequeno"> <!-- Image set via CSS -->
        </div>
        <div id="gallery-container">
            <!-- Columns generated by JS -->
        </div>
        <div id="scroll-controls">
            <button id="home-btn" title="Voltar ao Início"><i class="fas fa-home"></i></button>
            <button id="rewind-btn" title="Rebobinar (Muito Rápido)"><i class="fas fa-backward-fast"></i></button>
            <button id="pause-btn" title="Pausar Rolagem"><i class="fas fa-pause"></i></button>
            <button id="slow-btn" class="active" title="Rolagem Normal"><i class="fas fa-play"></i></button>
            <button id="fast-btn" title="Rolagem Rápida"><i class="fas fa-forward"></i></button>
            <button id="very-fast-btn" title="Rolagem Muito Rápida"><i class="fas fa-rocket"></i></button>
        </div>
        <button id="reset-gallery-btn" title="Voltar ao Início da Galeria">
            Reiniciar Galeria
            <span id="reset-countdown" style="display: none;"></span>
        </button>

        <!-- MODIFIED: Info Bar HTML -->
        <div id="info-bar">
            <!-- Make the address text clickable -->
            <span id="address-link" title="Clique para saber mais sobre o estúdio"> <!-- Added ID and title -->
                <i class="fas fa-map-marker-alt"></i> <!-- Changed icon -->
                See my studio! Torre Eiffel, Champ de Mars, 5 Av. Anatole France, 75007 Paris, França. <!-- Placeholder -->
            </span>
            <a href="https://instagram.com/SEU_PERFIL" target="_blank" rel="noopener noreferrer" title="Instagram">
                <i class="fab fa-instagram"></i>
                <span class="info-bar-label">@SEU_HANDLE</span> <!-- Replace with your handle -->
            </a>
            <a href="https://wa.me/SEU_NUMERO_WHATSAPP" target="_blank" rel="noopener noreferrer" title="WhatsApp"> <!-- Replace number here -->
                <i class="fab fa-whatsapp"></i>
                <span class="info-bar-label">SEU_NUMERO_FORMATADO</span> <!-- Replace with formatted number -->
            </a>
        </div>
        <!-- END MODIFIED -->
    </section>

    <!-- Image Lightbox (Structure Unchanged) -->
    <div id="lightbox">
        <div id="lightbox-content">
            <button id="lightbox-close" title="Fechar">×</button>
        </div>
    </div>

    <!-- NEW: Address/Studio Lightbox -->
    <div id="address-lightbox">
        <div id="address-lightbox-content">
             <button id="address-lightbox-close" title="Fechar">&times;</button>
             <img id="studio-image" src="images/studio.PNG" alt="Foto do Estúdio"> <!-- Placeholder Studio Image -->
             <p id="studio-description">
                Este é o nosso espaço criativo! Um ambiente inspirador onde a arte ganha vida na pele. Equipamentos de ponta, higiene rigorosa e uma atmosfera acolhedora esperam por você. Venha nos visitar e transformar sua ideia em uma tatuagem incrível.
             </p>
             <a id="map-link" href="https://www.google.com/maps/search/?api=1&query=Eiffel+Tower%2C+Paris%2C+France" target="_blank" rel="noopener noreferrer"> <!-- Placeholder Map Link -->
                 <i class="fas fa-map-marked-alt"></i>
                 <span>Ver no Google Maps</span>
             </a>
        </div>
    </div>
    <!-- END NEW -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- Element Refs ---
            const stage1 = document.getElementById('stage1');
            const stage2 = document.getElementById('stage2');
            const seeWorkBtn = document.getElementById('see-work-btn');
            const topLogo = document.getElementById('top-logo');
            const galleryContainer = document.getElementById('gallery-container');
            const scrollControls = document.getElementById('scroll-controls');
            const infoBar = document.getElementById('info-bar');
            const pauseBtn = document.getElementById('pause-btn');
            const slowBtn = document.getElementById('slow-btn');
            const fastBtn = document.getElementById('fast-btn');
            const veryFastBtn = document.getElementById('very-fast-btn');
            const rewindBtn = document.getElementById('rewind-btn');
            const homeBtn = document.getElementById('home-btn');
            const resetGalleryBtn = document.getElementById('reset-gallery-btn');
            const resetCountdownSpan = document.getElementById('reset-countdown');
            const lightbox = document.getElementById('lightbox');
            const lightboxContent = document.getElementById('lightbox-content');
            const lightboxCloseBtn = document.getElementById('lightbox-close');
            const addressLink = document.getElementById('address-link'); // NEW
            const addressLightbox = document.getElementById('address-lightbox'); // NEW
            const addressLightboxContent = document.getElementById('address-lightbox-content'); // NEW
            const addressLightboxCloseBtn = document.getElementById('address-lightbox-close'); // NEW
            const body = document.body;

            // --- Config & State (Unchanged) ---
            const baseScrollSpeedSlow = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--scroll-speed-slow'));
            const baseScrollSpeedFast = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--scroll-speed-fast'));
            const baseScrollSpeedVeryFast = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--scroll-speed-very-fast'));
            let numColumns = 2;
            let scrollSpeed = 0;
            let targetScrollSpeed = 0;
            let isPaused = true;
            let animationFrameId = null;
            let columnElements = [];
            let originalColumnHeights = [];
            let currentTranslations = [];
            let isTransitioning = false;
            let stage2Active = false;
            let wasPausedBeforeLightbox = false;
            let hasReachedEnd = false;
            let hasReachedTop = false;
            let heightsCalculated = false;
            let countdownIntervalId = null;
            let countdownTime = 5;

            // --- Functions (Setup, Scrolling, Basic Lightbox, Countdown, Buttons - Unchanged)---
            function updateColumnCount() { const width = window.innerWidth; numColumns = (width <= 768) ? 1 : 2; }
            function calculateAndStoreHeights() { let ok = true; if (!columnElements.length) return false; columnElements.forEach((c, i) => { c.offsetHeight; originalColumnHeights[i] = c.offsetHeight; if (originalColumnHeights[i] <= 10) { ok = false; console.warn(`Col ${i} height (${originalColumnHeights[i]}) small.`); } c.style.transform = `translateY(${currentTranslations[i]}px)`; }); if (ok) { heightsCalculated = true; console.log("Heights ok:", originalColumnHeights); return true; } else { console.error("Invalid heights."); heightsCalculated = false; return false; } }
            function setupGallery() { console.log("Setup gallery..."); if (typeof tattooImageUrls==="undefined"||!Array.isArray(tattooImageUrls)){console.error("PHP failed: tattooImageUrls array missing.");galleryContainer.innerHTML=`<p style="color:red;text-align:center;">Gallery Error: Image list failed.</p>`;return;}if(tattooImageUrls.length===0){console.warn("No images found by PHP.");galleryContainer.innerHTML=`<p style="text-align:center;color:var(--light-gray);">No images found.</p>`;return;}updateColumnCount();galleryContainer.innerHTML='';columnElements=[];originalColumnHeights=[];currentTranslations=[];hasReachedEnd=false;hasReachedTop=true;heightsCalculated=false;hideResetButton();for(let i=0;i<numColumns;i++){const c=document.createElement('div');c.className='gallery-column';galleryContainer.appendChild(c);columnElements.push(c);currentTranslations.push(0);}const numberOfImagesToShow=tattooImageUrls.length;console.log(`Creating ${numberOfImagesToShow} images.`);for(let i=0;i<numberOfImagesToShow;i++){const img=document.createElement('img');img.src=tattooImageUrls[i];img.alt=`Tatuagem ${i + 1}`;img.className='gallery-image';img.loading='lazy';img.addEventListener('click',()=>openLightbox(img.src));columnElements[i % numColumns].appendChild(img);}setTimeout(calculateAndStoreHeights,450);}
            function startScrollingAnimation() { if (stage2Active && !isPaused && heightsCalculated && !((targetScrollSpeed >= 0 && hasReachedEnd) || (targetScrollSpeed < 0 && hasReachedTop))) { if (!animationFrameId) { scrollSpeed = targetScrollSpeed; if(targetScrollSpeed > 0) hasReachedTop = false; if(targetScrollSpeed < 0) hasReachedEnd = false; animationFrameId = requestAnimationFrame(scrollColumns); } } else { if (isPaused || targetScrollSpeed === 0) setActiveButton(pauseBtn); } }
            function stopScrollingAnimation() { if (animationFrameId) { cancelAnimationFrame(animationFrameId); animationFrameId = null; } scrollSpeed = 0; }
            function resetGalleryPosition(shouldStartScroll = false, newSpeed = baseScrollSpeedSlow) { console.log("Resetting gallery pos."); stopScrollingAnimation(); clearCountdown(); currentTranslations = currentTranslations.map(() => 0); hasReachedEnd = false; hasReachedTop = true; hideResetButton(); columnElements.forEach((col) => { if (col) { col.style.transform = `translateY(0px)`; } }); setTimeout(() => { if (shouldStartScroll && heightsCalculated) { targetScrollSpeed = newSpeed; isPaused = false; setActiveButtonBasedOnSpeed(); startScrollingAnimation(); } else { if (!heightsCalculated) console.log("Reset: No scroll, heights invalid."); targetScrollSpeed = 0; isPaused = true; setActiveButton(pauseBtn); } }, 600); }
            function scrollToStage1() { if (isTransitioning || !stage2Active) return; console.log("Scroll to Stage 1"); isTransitioning = true; stage2Active = false; stopScrollingAnimation(); clearCountdown(); targetScrollSpeed = 0; isPaused = true; stage2.classList.remove('visible'); window.scrollTo({ top: 0, behavior: 'smooth' }); setTimeout(() => { stage1.style.opacity = 1; stage1.style.pointerEvents = 'auto'; stage2.style.display = 'none'; resetGalleryPosition(false); hideResetButton(); setActiveButton(slowBtn); isTransitioning = false; }, 650); }
            function scrollToStage2() { if (isTransitioning || stage2Active) return; console.log("Scroll to Stage 2"); isTransitioning = true; stage1.style.opacity = 0; stage1.style.pointerEvents = 'none'; resetGalleryPosition(false); stage2.style.display = 'block'; window.scrollTo({ top: stage1.offsetHeight, behavior: 'smooth' }); setTimeout(() => { stage2.classList.add('visible'); stage2Active = true; hideResetButton(); if (!heightsCalculated && typeof tattooImageUrls !== 'undefined' && tattooImageUrls.length > 0) { console.log("Recalc heights post-trans..."); calculateAndStoreHeights(); } else if (!heightsCalculated) { console.log("Waiting for images and heights...");} if (heightsCalculated) { isPaused = false; targetScrollSpeed = baseScrollSpeedSlow; setActiveButton(slowBtn); startScrollingAnimation(); } else if (typeof tattooImageUrls !== 'undefined' && tattooImageUrls.length > 0) { console.error("Anim disabled: heights invalid."); isPaused = true; targetScrollSpeed = 0; setActiveButton(pauseBtn); } isTransitioning = false; }, 650); }
            function openLightbox(imageUrl) { if (!lightbox.classList.contains('visible')) { lightboxContent.style.backgroundImage = `url('${imageUrl}')`; lightbox.classList.add('visible'); wasPausedBeforeLightbox = isPaused || (targetScrollSpeed === 0); if (!wasPausedBeforeLightbox) { stopScrollingAnimation(); } clearCountdown(); isPaused = true; body.classList.add('lightbox-open'); } }
            function closeLightbox() { if (lightbox.classList.contains('visible')) { lightbox.classList.remove('visible'); lightboxContent.style.backgroundImage = 'none'; body.classList.remove('lightbox-open'); isPaused = wasPausedBeforeLightbox; if (stage2Active && !isPaused && heightsCalculated && targetScrollSpeed !== 0 && !hasReachedEnd && !hasReachedTop) { startScrollingAnimation(); } else { setActiveButtonBasedOnSpeed(); } if (hasReachedEnd) { showResetButton(); startCountdown(); } } }
            function startCountdown() { if (!stage2Active || !hasReachedEnd || countdownIntervalId) return; console.log("Starting auto-reset countdown."); countdownTime = 5; resetCountdownSpan.textContent = `(${countdownTime})`; resetCountdownSpan.style.display = 'inline-block'; countdownIntervalId = setInterval(() => { countdownTime--; if (countdownTime > 0) { resetCountdownSpan.textContent = `(${countdownTime})`; } else { clearCountdown(); if (resetGalleryBtn.classList.contains('visible')) { console.log("Auto-resetting gallery!"); resetGalleryPosition(true, baseScrollSpeedSlow); } } }, 1000); }
            function clearCountdown() { if (countdownIntervalId) { console.log("Clearing auto-reset countdown."); clearInterval(countdownIntervalId); countdownIntervalId = null; resetCountdownSpan.textContent = ''; resetCountdownSpan.style.display = 'none'; } }
            function showResetButton() { if (resetGalleryBtn) resetGalleryBtn.classList.add('visible'); }
            function hideResetButton() { clearCountdown(); if (resetGalleryBtn) resetGalleryBtn.classList.remove('visible'); }
            function setActiveButton(activeBtn) { [pauseBtn, slowBtn, fastBtn, veryFastBtn, rewindBtn, homeBtn].forEach(btn => { if(btn) btn.classList.remove('active'); }); if (activeBtn) { activeBtn.classList.add('active'); } }
            function setActiveButtonBasedOnSpeed() { if (targetScrollSpeed === 0 || isPaused) { setActiveButton(pauseBtn); } else if (targetScrollSpeed === baseScrollSpeedSlow) { setActiveButton(slowBtn); } else if (targetScrollSpeed === baseScrollSpeedFast) { setActiveButton(fastBtn); } else if (targetScrollSpeed === baseScrollSpeedVeryFast) { setActiveButton(veryFastBtn); } else if (targetScrollSpeed === -baseScrollSpeedVeryFast) { setActiveButton(rewindBtn); } else { setActiveButton(null); } }
            function scrollColumns() { if (isPaused || !stage2Active || !heightsCalculated || (targetScrollSpeed >= 0 && hasReachedEnd) || (targetScrollSpeed < 0 && hasReachedTop)) { if (animationFrameId) { cancelAnimationFrame(animationFrameId); animationFrameId = null; } return; } const speedDiff = targetScrollSpeed - scrollSpeed; if (Math.abs(speedDiff) > 0.01) { scrollSpeed += speedDiff * 0.1; } else { scrollSpeed = targetScrollSpeed; } if (targetScrollSpeed === 0 && Math.abs(scrollSpeed) < 0.01) { scrollSpeed = 0; if (animationFrameId) cancelAnimationFrame(animationFrameId); animationFrameId = null; setActiveButton(pauseBtn); return; } if (scrollSpeed === 0) { if (animationFrameId) cancelAnimationFrame(animationFrameId); animationFrameId = null; return; } let reachedEndInThisFrame = false; let reachedTopInThisFrame = false; const infoBarTop = infoBar.getBoundingClientRect().top; const bottomMargin = 50; columnElements.forEach((col, index) => { if (!originalColumnHeights[index] || originalColumnHeights[index] <= 10) { return; } currentTranslations[index] -= scrollSpeed; if (scrollSpeed > 0) { const endThreshold = -(originalColumnHeights[index] - infoBarTop + bottomMargin); if (currentTranslations[index] <= endThreshold) { currentTranslations[index] = endThreshold; reachedEndInThisFrame = true; } } else if (scrollSpeed < 0) { if (currentTranslations[index] >= 0) { currentTranslations[index] = 0; reachedTopInThisFrame = true; } } col.style.transform = `translateY(${currentTranslations[index]}px)`; }); if (reachedEndInThisFrame) { console.log("Reached end"); stopScrollingAnimation(); targetScrollSpeed = 0; isPaused = true; hasReachedEnd = true; hasReachedTop = false; showResetButton(); startCountdown(); setActiveButton(pauseBtn); return; } if (reachedTopInThisFrame) { console.log("Reached top"); stopScrollingAnimation(); targetScrollSpeed = 0; isPaused = true; hasReachedTop = true; hasReachedEnd = false; setActiveButton(pauseBtn); return; } animationFrameId = requestAnimationFrame(scrollColumns); }

            // --- NEW: Address Lightbox Functions ---
            function openAddressLightbox() {
                if (!addressLightbox.classList.contains('visible')) {
                    addressLightbox.classList.add('visible');
                    wasPausedBeforeLightbox = isPaused || (targetScrollSpeed === 0);
                    if (!wasPausedBeforeLightbox) { stopScrollingAnimation(); }
                    clearCountdown(); isPaused = true; body.classList.add('lightbox-open');
                    console.log("Address Lightbox opened.");
                }
            }
            function closeAddressLightbox() {
                if (addressLightbox.classList.contains('visible')) {
                    addressLightbox.classList.remove('visible');
                    body.classList.remove('lightbox-open');
                    isPaused = wasPausedBeforeLightbox;
                    if (stage2Active && !isPaused && heightsCalculated && targetScrollSpeed !== 0 && !hasReachedEnd && !hasReachedTop) { startScrollingAnimation(); }
                    else { setActiveButtonBasedOnSpeed(); }
                    if (hasReachedEnd) { showResetButton(); startCountdown(); }
                     console.log("Address Lightbox closed.");
                }
            }
            // --- END Address Lightbox Functions ---

            // --- Event Listeners ---
            window.addEventListener('load', () => { setTimeout(() => { stage1.classList.add('visible'); }, 100); hideResetButton(); setupGallery(); setActiveButton(slowBtn); isPaused = true; targetScrollSpeed = 0; });
            seeWorkBtn.addEventListener('click', scrollToStage2);
            topLogo.addEventListener('click', scrollToStage1);
            homeBtn.addEventListener('click', scrollToStage1);
            pauseBtn.addEventListener('click', () => { console.log("Pause"); isPaused = true; targetScrollSpeed = 0; setActiveButton(pauseBtn); stopScrollingAnimation(); clearCountdown(); });
            slowBtn.addEventListener('click', () => { console.log("Slow"); if (!heightsCalculated) return; clearCountdown(); if (hasReachedEnd) { resetGalleryPosition(true, baseScrollSpeedSlow); } else { targetScrollSpeed = baseScrollSpeedSlow; isPaused = false; hasReachedEnd = false; hasReachedTop = false; setActiveButton(slowBtn); hideResetButton(); startScrollingAnimation(); } });
            fastBtn.addEventListener('click', () => { console.log("Fast"); if (!heightsCalculated) return; clearCountdown(); if (hasReachedEnd) { resetGalleryPosition(true, baseScrollSpeedFast); } else { targetScrollSpeed = baseScrollSpeedFast; isPaused = false; hasReachedEnd = false; hasReachedTop = false; setActiveButton(fastBtn); hideResetButton(); startScrollingAnimation(); } });
            veryFastBtn.addEventListener('click', () => { console.log("Very Fast"); if (!heightsCalculated) return; clearCountdown(); if (hasReachedEnd) { resetGalleryPosition(true, baseScrollSpeedVeryFast); } else { targetScrollSpeed = baseScrollSpeedVeryFast; isPaused = false; hasReachedEnd = false; hasReachedTop = false; setActiveButton(veryFastBtn); hideResetButton(); startScrollingAnimation(); } });
            rewindBtn.addEventListener('click', () => { console.log("Rewind"); if (!heightsCalculated) return; clearCountdown(); if (targetScrollSpeed < 0 && !isPaused) return; if (hasReachedTop) { isPaused = true; targetScrollSpeed = 0; setActiveButton(pauseBtn); stopScrollingAnimation(); return; } targetScrollSpeed = -baseScrollSpeedVeryFast; isPaused = false; hasReachedEnd = false; hasReachedTop = false; setActiveButton(rewindBtn); hideResetButton(); startScrollingAnimation(); });
            resetGalleryBtn.addEventListener('click', () => { console.log("Manual Reset"); if (!heightsCalculated) { resetGalleryPosition(false); return; } clearCountdown(); resetGalleryPosition(true, baseScrollSpeedSlow); });

            // --- Lightbox Listeners ---
            lightboxCloseBtn.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', (e) => { if (e.target === lightbox) { closeLightbox(); } }); // Close image lightbox on overlay click

            // --- NEW: Address Lightbox Listeners ---
            addressLink.addEventListener('click', openAddressLightbox);
            addressLightboxCloseBtn.addEventListener('click', closeAddressLightbox);
            addressLightbox.addEventListener('click', (e) => { if (e.target === addressLightbox) { closeAddressLightbox(); } }); // Close address lightbox on overlay click

            // Wheel Listener (Unchanged)
            let wheelScrollTimeout; window.addEventListener('wheel', (e) => { if (lightbox.classList.contains('visible') || addressLightbox.classList.contains('visible') || isTransitioning) { e.preventDefault(); return; } if (stage2Active) { const scrollUp = e.deltaY < 0; const isGalleryNearTop = currentTranslations.some(t => t > -10); if (scrollUp && isGalleryNearTop) { } else { e.preventDefault(); return; } } const scrollDown = e.deltaY > 0; const scrollUp = e.deltaY < 0; clearTimeout(wheelScrollTimeout); wheelScrollTimeout = setTimeout(() => { isTransitioning = false; }, 200); const stage1Bottom = stage1.offsetTop + stage1.offsetHeight; const currentScrollY = window.scrollY; const inStage1View = currentScrollY < stage1Bottom * 0.8; if (scrollDown && inStage1View && !stage2Active) { scrollToStage2(); } else if (scrollUp && stage2Active) { const isGalleryNearTop = currentTranslations.some(t => t > -10); if (isGalleryNearTop) { scrollToStage1(); } } }, { passive: false });
            // Resize Listener (Unchanged)
             let resizeTimeout; window.addEventListener('resize', () => { clearTimeout(resizeTimeout); resizeTimeout = setTimeout(() => { console.log("Resize"); const previousColumnCount = numColumns; updateColumnCount(); if (stage2Active) { console.log("Recalc gallery on resize."); stopScrollingAnimation(); const previouslyPaused = isPaused; const previousSpeed = targetScrollSpeed; isPaused = true; targetScrollSpeed = 0; resetGalleryPosition(false); setupGallery(); setTimeout(() => { if (heightsCalculated && !previouslyPaused) { targetScrollSpeed = previousSpeed; isPaused = false; setActiveButtonBasedOnSpeed(); startScrollingAnimation(); } else if (!heightsCalculated) { console.error("Resize: heights invalid."); setActiveButton(pauseBtn); } else { setActiveButton(pauseBtn); } }, 450); } else { setupGallery(); } }, 250); });

        }); // End DOMContentLoaded
    </script>

</body>
</html>