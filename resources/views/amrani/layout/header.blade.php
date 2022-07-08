<div class="flex items-center justify-between shadow-lg border-b border-gray-300 h-14">
    <div class="flex items-center">
        <button class="mr-3 p-4 py-5 hover:bg-gray-100 text-lg active:bg-blue-500 focus:outline-none hover:bg-gray-300 focuse:border-0 toggle_vertical_navbar"><i class="fas fa-bars"></i></button>
        <div class="rounded-lg border overflow-hidden relative">
            <input type="text" class="border-0 text-sm w-64" placeholder="Chercher">
            <button class="absolute top-0 right-0 m-2 pt-1 text-sm text-gray-400"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="flex items-center pr-4">
        
        <div class="rounded-full cursor-pointer hover:bg-gray-300 p-2 bg-gray-200 m-2"><i class="far fa-user"></i></div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.toggle_vertical_navbar').on('click', function(){
            $(this).toggleClass('bg-gray-600 text-gray-100')
            $('.vertical_menu').toggleClass('hidden', 1000);
        })
    });
</script>