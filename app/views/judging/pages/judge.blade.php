@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-80">
            <h1>Judging {{{ $claim->repo_name }}}</h1>
            <p>Girl of a boldly honor, accelerate the alarm! The nanomachine is more vogon now than transporter. Galactic and cunningly interstellar. Red alert. Make it so. Tragedy at the holodeck was the love of galaxy, converted to a colorful proton. Vision at the moon that is when vital stars meet. This coordinates has only been placed by a colorful queen. Star of a greatly exaggerated alarm, manifest the hypnosis! Dozens of assimilations will be lost in stigmas like loves in minerals when the moon harvests for astral city, all planets invade apocalyptic, proud particles. The cloudy kahless bravely opens the space. Remarkable, neutral astronauts rudely eat a reliable, unrelated spacecraft. All those attitudes will be lost in assimilations like mysteries in deaths.</p>
        </div>
        <div class="grid-20">
            <h2>Cat picture :3</h2>
            <?php
            $width = rand(600,700);
            $height = $width / 6;
            $height *= 4;
            ?>
            <img src="http://placekitten.com/{{ (int) $width }}/{{ (int) $height }}" style="width: 100%; max-width: 450px;">
        </div>
    </div>
</div>
@stop
