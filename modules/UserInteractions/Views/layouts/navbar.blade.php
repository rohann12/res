<nav class="px-6 lg:px-28 py-6 bg-white shadow md:flex md:items-center md:justify-between z-0 overflow-hidden" >
        <div class="flex justify-between items-center" style="height: 50px;">
            <span class="text-2xl cursor-pointer h-full">
                <img src="{{ asset('images/' . $company->logo) }}" alt="icon" class="h-full">
            </span>
            <span class="text-3xl cursor-pointer mx-2 md:hidden block">
                <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
            </span>
        </div>

        <ul
            class="md:flex md:items-center justify-center z-[-1] md:z-0 md:static absolute bg-white w-full left-0 md:w-auto md:py-0 py-4 capitalize md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in ">
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('home') }}" class="text-base flex items-center justify-center">Home</a>
            </li>
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('about') }}" class="text-base flex items-center justify-center">About Us</a>
            </li>
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('services') }}" class="text-base flex items-center justify-center">Services</a>
            </li>
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('projects') }}" class="text-base flex items-center justify-center">Projects</a>
            </li>
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('news') }}" class="text-base flex items-center justify-center">News</a>
            </li>
            <li class="mx-5 my-6 md:my-0">
                <a href="{{ route('contact') }}" class="text-base flex items-center justify-center">Contact</a>
            </li>
            <h2 class=""></h2>
        </ul>
    </nav>
    <script>
            function Menu(e) {
            let list = document.querySelector('ul');

            if (e.name === 'menu') {
                e.name = "close";
                list.classList.add('top-[70px]');
                list.classList.add('opacity-100');
                list.style.backgroundColor = '#01A6DE';
                list.style.zIndex = '9999'; // Bring the menu in front
            } else {
                e.name = "menu";
                list.classList.remove('top-[80px]');
                list.classList.remove('opacity-100');
                list.style.backgroundColor = 'transparent';
                list.style.zIndex = ''; // Remove the inline z-index
            }

            let items = list.querySelectorAll('li');
            items.forEach(item => {
                item.onmouseover = function() {
                    this.querySelector('a').style.color = 'white';
                };
                item.onmouseout = function() {
                    this.querySelector('a').style.color = 'black';
                };
            });
        }
        
        document.addEventListener("DOMContentLoaded", function() {
        // Get the current page URL
        const currentPageUrl = window.location.href;

        // Get all navigation links
        const navLinks = document.querySelectorAll('nav ul li a');

        // Loop through each link
        navLinks.forEach(link => {
            if (link.href === currentPageUrl) {
                // Add active class to the link
                link.classList.add('active');
            }
        });
    });


    </script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
