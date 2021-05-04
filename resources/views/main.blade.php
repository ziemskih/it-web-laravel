<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <h1>helo wr0ld</h1>
        {{ Illuminate\Support\Facades\Hash::make('a') }} <br>
        {{ Illuminate\Support\Facades\Hash::make('a') }} <br><br>
{{--        {{ Illuminate\Support\Facades\Hash::bcrypt('a') }}--}}
        <?php
            use Illuminate\Support\Facades\Hash;
            use App\Models\User;

/*            $a = bcrypt('a');
            echo bcrypt($a);
            echo '<br>';
            echo Hash::check('a', $a);
            echo '<br>';
            echo '<br>';

            $b = Hash::make('a');
            echo $b;
            echo '<br>';
            echo Hash::check('a', $b);*/

            $cs = User::all();
//            $cs->isEmpty();
            echo 'count($cs) = ' . count($cs) . '<br>';
            echo 'empty($cs) = ' . (empty($cs) ? 'true' : 'not true');
        ?>
    </body>
</html>
