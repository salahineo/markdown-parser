# Markdown Parser

## Goal

This is a Markdown to HTML parser and generator application. Markdown files are live parsed into HTML files with a lot
of functionalities, and you can generate an HTML file from custom Markdown syntax

> Please read the next instructions carefully, to know how to use this application correctly

> This page parsed by the `markdown/index.md` file, please don't remove it.

## Features

- Live parsing for Markdown files
- Export parsed markdown file to HTML file
- Generate HTML files from custom Markdown syntax
- Multiple themes
- Responsive view
- Table of content (generated from `h2` and `h3` elements only)
- Filter table of content
- Copy block of code content
- Syntax highlighting for most known languages
- Convert `H6` element to table of content separator

> You can see the [Example.html](../example/Example.html) file, that has been generated from [Example.md](../example/Example.md) file

## Structure

### Directories

|Directory|Description|
|---|---|
|assets|Include project UI files (CSS, JS, Images, ...)|
|example|Include example of markdown file and its generated HTML file|
|generated|Will contain generated HTML files from Markdown files|
|markdown|Should contain markdown files for live parsing|

> Please don't change directories names

### Pages

|Page|Description|
|---|---|
|[Home](../index.php)|It is the current page which contain project instructions and list of markdown files in markdown directory|
|[Generate](../generate.php)|Generate HTML from Markdown syntax page (generated pages will be in the generated directory)|
|[Example](../example/Example.html)|Contain samples of Markdown syntax exported to HTML|

## Workflow

### Live Parsing

- Create a Markdown file with any name, like `Sample File.md`
- Copy this Markdown file to `markdown` directory in this project (You can put it inside a directory as category for
  multiple markdown files)
- Open the [home page](../index.php), and you will found this file in the left table of content (search with file name)
- Click on it, and it will be parsed and opened on another browser tab

> This application supports only 2 levels or fewer in the `markdown` directory. So you can create a Markdown file and put it inside the `markdown` directory,
> or create a directory then assign this Markdown file to it. Two directories inside each other not acceptable

> You will found and icon at the top right of parsed Markdown file, by clicking on it, you can generate an HTML file from current parsed
> markdown file. This generated file will be in the `generated` directory

### Generate

- Write your Markdown syntax
- Go to [Generate Page](../generate.php)
- Type a name for your generated HTML file
- Copy and paste your Markdown syntax in the textarea
- Generate the HTML file

> The generated HTML file will be in the `generated` directory

## Instructions

- If there is an image, you need to put it in the `assets/images/cheatsheets`, and make sure that, the markdown file
  have the same path for the image src
- If you copy any file from `generated` directory and paste it to another location it will not work, because the missing
  of required styles and scripts. You can copy he `generated` and `assets` directories together to any location, and all
  generated HTML files will work perfectly
- Don't try to crack this application by inject malicious code in the [Generate Page](../generate.php), and remember it
  runs on your local-server

> Any content will be on your local-server, no data, or images will be published remotely
