#!/bin/bash

clear

echo -n "Do you want the version in Mask(yes) or Normal(n) format ??"
read answer

printf "\n 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 \n\n"

generateSassMask() {
    class="$(basename "$1")"
    out="$(basename "$class" .svg)"
    echo ' &.i-'$out' {
            &::before {
            content: "";
                @include prefixer("mask", (url("../'$1'") no-repeat 0 0));
                @include prefixer("mask-size", cover);
                background-size: 30px 30px;
            }
        }'
}

generateSass() {
    class="$(basename "$1")"
    out="$(basename "$class" .svg)"

    echo ' &.i-'$out' {
                &::before {
                 content: "";
                    background: url("../'$1'") no-repeat 0 0;
                    background-size: 30px 30px;
                }
            }'
}

if [ "$answer" != "${answer#[Yy]}" ]; then
    for d in img/icons/*; do
        if [[ -d $d ]]; then
            class="$(basename "$d")"
            for e in img/icons/$class/*; do
                generateSassMask $e
            done
        else
            generateSassMask $d
        fi
    done
else
    for d in img/icons/*; do
        if [[ -d $d ]]; then
            class="$(basename "$d")"
            for e in img/icons/$class/*; do
                generateSass $e
            done
        else
            generateSass $d
        fi
    done
fi
printf "\n\n 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 🍍 \n"

printf "\n Put all the printed text, except 🍍, inside the _icons.scss file inside the .i class \n\n"
