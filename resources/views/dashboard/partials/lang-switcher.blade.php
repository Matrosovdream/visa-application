<h2 class="fs-6 fw-bold pt-5 pb-3">
    Translations
</h2>

<ul class="list-unstyled">

    @foreach($languages as $lang)

        <li class="navi-item mb-2">
            <a href="?lang={{ $lang['code'] }}" class="navi-link {{ ($activeLang == strtolower($lang['code']) ) ? 'fw-bolder' : '' }}">
                <span class="navi-text">{{ $lang['name'] }}</span>
            </a>
        </li>

    @endforeach

</ul>
