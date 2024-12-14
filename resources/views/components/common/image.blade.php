@props([
    "src" => null,
    "height" => 500,
    "width" => 500,
])

<div class="commonImgDiv" >
    <img src="{{ urlVersion($src) }}"
         loading="lazy"
         class="cmnImg"
         style="heigth:150px;width:150px;"
         alt="Image ALT "
    />
</div>
