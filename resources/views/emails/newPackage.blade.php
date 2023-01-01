<x-mail::message>
# You've got a package!

Please login to our site to check the status of your package.

<x-mail::button :url="'http://site.com/packages'">
My Packages
</x-mail::button>

Thanks,<br>
<!-- {{ config('app.name') }} -->
</x-mail::message>
