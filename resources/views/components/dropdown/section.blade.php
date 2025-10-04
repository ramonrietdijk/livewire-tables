@props(['section'])

<section
    {{
        $attributes->merge([
            'x-data' => Js::from(['section' => $section]),
            'x-show' => 'current === section',
        ])->class([
            'flex flex-col',
        ])
    }}
>
    {{ $slot }}
</section>
