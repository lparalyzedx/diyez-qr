<ul>
    @foreach ($categories as $categorie)
        @if($categorie->childs->isNotEmpty())
            <li>
                <a href="{{ route('category', ['accountSlug' => $account->slug, 'slug' => $categorie->slug]) }}" class="v2_drop_action">{{ $categorie->name }}</a>
                @include('front.partials.category-child',['categories' => $categorie->childs])
            </li>
        @else
            <li>
                <a href="{{ route('category', ['accountSlug' => $account->slug, 'slug' => $categorie->slug]) }}">{{ $categorie->name }}</a>
            </li>
        @endif
    @endforeach
</ul>