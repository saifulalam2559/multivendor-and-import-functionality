
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

### ExampleController.php

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Imports\VendorsImport;
use Maatwebsite\Excel\Facades\Excel;

class ExampleController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new VendorsImport, $request->file('file'));

        return back()->with('success', 'Vendors imported successfully.');
    }

    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }
}
```

## Model Code

### Vendor.php

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address'];
}
```

## Import Code

### VendorsImport.php

```php
namespace App\Imports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;

class VendorsImport implements ToModel
{
    public function model(array $row)
    {
        return new Vendor([
            'name' => $row[0],
            'email' => $row[1],
            'address' => $row[2],
        ]);
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
