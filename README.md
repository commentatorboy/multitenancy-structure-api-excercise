# Just an excersice

This is made in laravel, so to run it, just do the following:

Install laravel on linux (or follow the guide at https://laravel.com/docs/12.x)
1. `/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"`
2. composer global require laravel/installer

Navigate to the folder and then:
1. php artisan serve
2. go to http://127.0.0.1:8000/tree to see the example

## Structure
To see the different models and controllers check `app\Http\Controllers\TreeController.php` and `app\Models`

## Further Work
Technically you could have made a NodeController that implemented the "addChild", "removeChild" etc., and then expose it to the REST api. But for simplicity, I have left that out. 

Other things that could be worked on (that is outside of this scope):
- Tree walk, to print the whole tree
- Searching for a specific property, building etc.