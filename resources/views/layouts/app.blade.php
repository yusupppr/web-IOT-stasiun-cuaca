<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Terobos')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/banner-image.png') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Swiper Customization */
        .swiper-pagination-bullet {
            background: #3B82F6;
            opacity: 0.3;
        }
        
        .swiper-pagination-bullet-active {
            background: #3B82F6;
            opacity: 1;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: #3B82F6;
            background: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #3B82F6;
            color: white;
            transform: scale(1.1);
        }
        
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
            font-weight: bold;
        }
        
        /* Layout Components */
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 51, 234, 0.1) 100%);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        /* Animations */
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px); 
            }
            50% { 
                transform: translateY(-10px); 
            }
        }
        
        .pulse-animation {
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { 
                transform: scale(1); 
            }
            50% { 
                transform: scale(1.05); 
            }
        }
        
        /* Utility Classes */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    @include('partials.navbar')
    
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>
    
    <script>
      // Konfigurasi Firebase Anda
      const firebaseConfig = {
        apiKey: "AIzaSyCbL7l7iwrVHiXk9MtZc0w-D-4-GVDDqTk",
        authDomain: "webterobos.firebaseapp.com",
        projectId: "webterobos",
        storageBucket: "webterobos.firebasestorage.app",
        messagingSenderId: "701078857283",
        appId: "1:701078857283:web:7011eac41b42e023f1d6f6"
      };
      
      // Inisialisasi Firebase
      firebase.initializeApp(firebaseConfig);
      const auth = firebase.auth();
    </script>
    
    <script>
        // Initialize Swiper for Projects
        const projectsSwiper = new Swiper('.projects-swiper', {
            // ... (konfigurasi swiper Anda) ...
        });

        // Initialize Swiper for Products
        const productsSwiper = new Swiper('.products-swiper', {
            // ... (konfigurasi swiper Anda) ...
        });

        // Initialize Swiper for News
        const newsSwiper = new Swiper('.news-swiper', {
            // ... (konfigurasi swiper Anda) ...
        });

        // DOM Content Loaded Event
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS Animation
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Add smooth scrolling to section links
            const sectionLinks = document.querySelectorAll('a[href^="#"]');
            sectionLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all card elements
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            
            // ===== [LOGIKA LOGOUT FIREBASE DITAMBAHKAN DI SINI] =====
            const logoutFormDesktop = document.getElementById('logout-form-desktop');
            const logoutFormMobile = document.getElementById('logout-form-mobile');

            const handleFirebaseLogout = (event) => {
                // 1. Mencegah form submit ke Laravel
                event.preventDefault(); 
                const form = event.target; // Ambil form yang di-submit

                // 2. Logout dari Firebase JS (pastikan 'auth' sudah ada dari skrip Firebase)
                if (typeof auth !== 'undefined') {
                    auth.signOut()
                        .then(() => {
                            // 3. Setelah sukses, BARU submit form ke Laravel
                            form.submit();
                        })
                        .catch((error) => {
                            console.error('Logout Firebase Gagal:', error);
                            // Jika gagal, paksa submit form Laravel
                            form.submit();
                        });
                } else {
                    // Fallback jika Firebase tidak ter-load
                    console.error('Firebase auth object not found.');
                    form.submit();
                }
            };

            if (logoutFormDesktop) {
                logoutFormDesktop.addEventListener('submit', handleFirebaseLogout);
            }
            if (logoutFormMobile) {
                logoutFormMobile.addEventListener('submit', handleFirebaseLogout);
            }

        });
    </script>
</body>
</html>