@props(['size'=> 'base']);


@php
$classes = "bg-white/10 hover:bg-white/25  my-1 rounded-xl font-bold transition-colors duration-300";

if($size === 'base'){}

if($size === 'small'){
    $classes += 'px-3 py-1 text-2xs';
}
    
@endphp
<a href="">{{$slot}}</a>
