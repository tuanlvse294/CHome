#!/usr/bin/env bash
find ./ -name \*.puml |xargs -I{} sh -c 'plantuml $1 -charset UTF-8 -o ~/Desktop/image/`dirname $1`' -- {}
