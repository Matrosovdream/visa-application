<nav class="text-sm text-gray-500 mb-4">
    Home &gt;
    <span class="text-blue-600">
        {{ $article['title'] }}
    </span>
</nav>

<h1 class="text-3xl font-bold mb-2">
    {{ $article['title'] }}
</h1>

<div class="flex items-center text-gray-600 text-sm mb-6">
    <img src="https://icon2.cleanpng.com/20180705/wjv/kisspng-computer-icons-user-interface-administrator-5b3ebfcc7ce331.3763403515308389885116.jpg"
        alt="Author" class="rounded-full w-8 h-8 mr-2">
    <span class="font-semibold">Admin</span>
    <span class="mx-2">|</span>
    <span>
        10 min read
    </span>
    <span class="mx-2">|</span>
    <span>Updated on {{ $article['Model']->created_at->format('F j, Y') }}</span>
</div>