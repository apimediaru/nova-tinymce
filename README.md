# TinyMCE integration for Laravel Nova

## Install
```composer require apimediaru/nova-tinymce```

## Publishing assets
### Config
```php artisan vendor:publish --tag=nova-tinymce-config```
### Localizations
```php artisan vendor:publish --tag=nova-tinymce-lang```

## Usage
Example of usage in Nova:
```
use APIMedia\TinyMCE\TinyMCE;

/**
 * Get the fields displayed by the resource.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function fields(Request $request)
{
    return [
        // ...

        TinyMCE::make('Content'), 'content'),
    ];
}

```

## Configurable parameters
TinyMCE frontend display height. Passing ```int``` means height in pixels, but also you can pass ```string``` with a css value, for example, ```20rem```.
```
TinyMCE::make('Content'), 'content')
  ->height(150),
```

Override default editor settings for a certain field: ```editorConfig(array $config): array```.  
Docs for TinyMCE can be found [here](https://www.tiny.cloud/docs/).
```
TinyMCE::make('Content'), 'content')
  ->editorConfig([
    'menubar' => false,
    'plugins' => [
      // Some plugins
    ],
    'toolbar' => 'any custom toolbar items',
    // ...
  ]),
```
