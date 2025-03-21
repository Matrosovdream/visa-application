<h2 class="fs-6 fw-bold pt-5 pb-3">Languages</h2>

<ul>

    @foreach($languages as $lang)

        <li class="navi-item mb-2">
            <a href="?lang={{ $lang['code'] }}" class="navi-link {{ $activeLang == $lang['code'] ?? 'active' }}">
                <span class="navi-text">{{ $lang['name'] }}</span>
            </a>
        </li>

    @endforeach


</ul>