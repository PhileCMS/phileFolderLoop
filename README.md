phileFolderLoop
===================

Loop through a folder of files with Twig

### 0.9.*

This version currently works with 0.9.\*. I havent built the 1.\* version yet!

### Installation

* Install [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phileFolderLoop`
* add `$config['plugins']['phileFolderLoop'] = array('active' => true);` to your `config.php`

### Usage

In the config there is a list of acceptable file types. The default is for images, so it looks like this:

```
'image_types' => 'jpg|jpeg|svg|png|gif|webp|ico|bmp'
```

You can change this to match the type of files that you want to show.

There will now be a new twig function called `loop`. It takes a path to a folder (relative to the ROOT_DIR, your root installation directory) and grabs all the images in there.

Example:

```twig
<div class="grid photo-loop">
  {% set images = loop('content/images/products') %}
  {% for image in images %}
    <div class="col-1-2">
      <a href="{{ image.url }}" data-count="{{ image.id }}" target="_blank">
        <img src="{{ image.url }}" width="{{ image.width }}" height="{{ image.height }}" alt="{{ image.name }}">
      </a>
    </div>
  {% endfor %}
</div>
```

Output:

```html
<div class="grid photo-loop">
  <div class="col-1-2">
    <a href="content/images/products/IMG_7044.jpg" data-count="0" target="_blank">
      <img src="content/images/products/IMG_7044.jpg" width="522" height="348" alt="IMG_7044">
    </a>
  </div>
</div>
```


