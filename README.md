
# Multivendor and Import Functionality using Laravel

This repository provides a Laravel implementation for multivendor and import functionalities.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Controller Code](#controller-code)
- [Model Code](#model-code)
- [Import Code](#import-code)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/saifulalam2559/multivendor-and-import-functionality.git
    ```
2. Navigate to the project directory:
    ```sh
    cd multivendor-and-import-functionality
    ```
3. Install the dependencies:
    ```sh
    composer install
    ```
4. Copy the example environment file and make the necessary configurations:
    ```sh
    cp .env.example .env
    ```
5. Generate the application key:
    ```sh
    php artisan key:generate
    ```
6. Run the database migrations:
    ```sh
    php artisan migrate
    ```

## Usage

To start the development server, run:
```sh
php artisan serve
```
Access the application at `http://localhost:8000`.

## Controller Code

### UserRoleController.php

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kunden;

class UserRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    

    public function index()
    {
        if (auth()->user()->role === "admin") {
            return redirect()->route("admin.dashboard");
        } elseif (auth()->user()->role === "seller") {
            return redirect()->route("ukunden.listing");
        } elseif (auth()->user()->role === "freelancer") {
            return redirect()->route("freelancer.dashboard");
        } else {
            return redirect()
                ->route("/")
                ->with("error", "Email and password are wrong");
        }
    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);

        $user->status = $request->status;

        $user->save();

        return response()->json(["success" => "Status change successfully."]);
    }


    public function adminDashboard()
    {
        return view("backend.admin.index");
    }


    public function adminProfile()
    {
        return view("backend.admin.profile");
    }


    public function sellerDashboard()
    {
        return view("backend.seller.index");
    }


    public function sellerProfile()
    {
        return view("backend.seller.profile");
    }


    public function freelancerDashboard()
    {
        return view("backend.freelancer.index");
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate(); 
        return redirect("/")->with(Auth::logout());
         return redirect('login')->with(Auth::logout());
    }
}
```

## Model Code

### Note.php

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kunden;


class Note extends Model
{
    use HasFactory;
    
            protected $fillable = [
            
            'note_title',
            'note_description',
            'kunden_id',
            'user_id',


    ];
            
            
            public function kunden() {

            return $this->belongsTo(Kunden::class,'kunden_id','id');

        }
        
        
         public function user() {

            return $this->belongsTo(User::class);

        }
           
            
}
```

## Import Code

### VendorsImport.php

```php
namespace App\Imports;

use App\Models\Note;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class NoteImport implements ToModel, WithHeadingRow, SkipsOnError
{
    public function model(array $row)
    {
        $username = trim($row["user_id"]);

        $user = User::where("name", $username)->first();

        if ($user) {
            return new Note([
                "user_id" => $user->id,
                "kunden_id" => 19,
                "note_title" => $row["note_title"],
                "note_description" => $row["note_description"],
            ]);
        } else {
            return null;
        }
    }

    public function onError(Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}

        
```

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add some feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
