# Sorani Calendar - Laravel Package

[![Latest Version](https://img.shields.io/github/release/bryarghafoor/sorani-calendar.svg?style=flat-square)](https://github.com/bryarghafoor/sorani-calendar/releases)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

A Laravel package for converting Gregorian dates to Sorani Kurdish calendar. This package provides an easy-to-use interface for working with Kurdish dates in your Laravel applications.

## Features

- ✅ Convert Gregorian dates to Sorani Kurdish calendar
- ✅ Get current date in Kurdish calendar
- ✅ Support for multiple date formats
- ✅ Helper functions for easy usage
- ✅ Facade support
- ✅ Configurable month and day names
- ✅ Laravel 10+ support

## Installation

### Via Composer (from Packagist)

Once published to Packagist, you can install the package via composer:

```bash
composer require bryarghafoor/sorani-calendar
```

### Local Development (from packages directory)

For local development, add this to your project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "./packages/sorani-calendar"
        }
    ],
    "require": {
        "bryarghafoor/sorani-calendar": "dev-main"
    }
}
```

Then run:

```bash
composer update bryarghafoor/sorani-calendar
```

### Service Provider Registration

The package will automatically register its service provider in Laravel 5.5+.

For older versions, add the service provider to `config/app.php`:

```php
'providers' => [
    // ...
    BryarGhafoor\SoraniCalendar\SoraniCalendarServiceProvider::class,
],
```

### Facade (Optional)

Add the facade to your `config/app.php`:

```php
'aliases' => [
    // ...
    'SoraniCalendar' => BryarGhafoor\SoraniCalendar\Facades\SoraniCalendar::class,
],
```

### Publish Configuration (Optional)

Publish the configuration file:

```bash
php artisan vendor:publish --tag=sorani-calendar-config
```

## Usage

### Using Facade

```php
use BryarGhafoor\SoraniCalendar\Facades\SoraniCalendar;

// Get current date in Kurdish calendar
$today = SoraniCalendar::now();
// Returns: ['day' => 21, 'month' => 11, 'year' => 2726, 'monthName' => 'رێبه‌ندان', 'dayName' => 'یه‌کشه‌ممه']

// Convert specific date
$date = SoraniCalendar::convert('2024-03-21');
// or
$date = SoraniCalendar::convert(new DateTime('2024-03-21'));

// Format date
$formatted = SoraniCalendar::format($date, 'full');
// Returns: "یه‌کشه‌ممه، 1 خاکه‌لێوه 2724"

$formatted = SoraniCalendar::format($date, 'date');
// Returns: "1 خاکه‌لێوه 2724"

$formatted = SoraniCalendar::format($date, 'short');
// Returns: "1/1/2724"

// Get month names
$months = SoraniCalendar::getMonthNames();

// Get day names
$days = SoraniCalendar::getDayNames();

// Check if year is leap year
$isLeap = SoraniCalendar::isLeapYear(2024);
```

### Using Helper Functions

```php
// Get current date
$today = sorani_now();

// Convert specific date
$date = sorani_calendar('2024-03-21');

// Format date
$formatted = sorani_format($date, 'full');

// Get month names
$months = sorani_month_names();

// Get day names
$days = sorani_day_names();
```

### Using in Blade Templates

```blade
{{-- Display current Kurdish date --}}
<p>ڕێکەوت: {{ sorani_format(sorani_now(), 'full') }}</p>

{{-- Display specific date --}}
@php
    $kurdishDate = sorani_calendar($document->created_at);
@endphp
<p>{{ sorani_format($kurdishDate, 'date') }}</p>

{{-- Using with your template variables --}}
<div>
    <p>ڕێکەوت : {{ $kurdishYear }} کوردی</p>
    <p>{{ $kurdishDay }} {{ $kurdishMonth }}</p>
</div>
```

### Integration with Your Document Flow Template

Update your controller to pass Kurdish date data:

```php
use BryarGhafoor\SoraniCalendar\Facades\SoraniCalendar;

class DocumentFlowController extends Controller
{
    public function show($id)
    {
        $document = DocumentFlow::findOrFail($id);
        
        // Convert current date to Kurdish
        $kurdishDate = SoraniCalendar::now();
        
        return view('components.document-flow.out-going-template', [
            'document' => $document,
            'kurdishYear' => $kurdishDate['year'],
            'kurdishMonth' => $kurdishDate['monthName'],
            'kurdishDay' => $kurdishDate['day'],
        ]);
    }
}
```

## Month Names (Sorani)

1. خاکه‌لێوه (Khakelewah) - March-April
2. گوڵان (Gulan) - April-May
3. جۆزه‌ردان (Jozerdan) - May-June
4. پووشپه‌ڕ (Pushper) - June-July
5. گه‌لاوێژ (Gelawezh) - July-August
6. خه‌رمانان (Khermanan) - August-September
7. ره‌زبه‌ر (Rezber) - September-October
8. خه‌زه‌ڵوه‌ر (Khezelwer) - October-November
9. سه‌رماوه‌ز (Sermawez) - November-December
10. به‌فرانبار (Befranbar) - December-January
11. رێبه‌ندان (Rebendan) - January-February
12. ره‌شه‌مێ (Resheme) - February-March

## Day Names (Sorani)

- یه‌کشه‌ممه (Yekshamah) - Sunday
- دووشه‌ممه (Dushamah) - Monday
- سێشەممه (Seshamah) - Tuesday
- چوارشه‌ممه (Charshamah) - Wednesday
- پێنجشه‌ممه (Penjshamah) - Thursday
- هه‌ینی (Heini) - Friday
- شه‌ممه (Shamah) - Saturday

## Testing

```bash
composer test
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Credits

- Conversion algorithm based on [rojcode/kurdishCalendars](https://github.com/rojcode/kurdishCalendars)
- Package developed by [Bryar Ghafoor](https://github.com/bryarghafoor)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email bryar@example.com instead of using the issue tracker.
