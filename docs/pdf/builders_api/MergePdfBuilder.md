# MergePdfBuilder

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### addMetadata(string $key, string $value)
The metadata to write.

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### downloadFrom(array $downloadFrom)
Sets download from to download each entry (file) in parallel (URLs MUST return a Content-Disposition header with a filename parameter.).<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#download-from](https://gotenberg.dev/docs/routes#download-from)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### files(Stringable|string $paths)
Add PDF files to merge.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### flatten(bool $bool)
Flattening a PDF combines all its contents into a single layer. (default false).

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### metadata(array $metadata)
Resets the metadata.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#metadata-chromium](https://gotenberg.dev/docs/routes#metadata-chromium)<br />
> See: [https://gotenberg.dev/docs/routes#metadata-libreoffice](https://gotenberg.dev/docs/routes#metadata-libreoffice)<br />
> See: [https://gotenberg.dev/docs/routes#write-pdf-metadata-route](https://gotenberg.dev/docs/routes#write-pdf-metadata-route)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)<br />
> See: [https://exiftool.org/TagNames/XMP.html#pdf ](https://exiftool.org/TagNames/XMP.html#pdf )

### pdfFormat(?Sensiolabs\GotenbergBundle\Enumeration\PdfFormat $format)
Convert the resulting PDF into the given PDF/A format.

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### pdfUniversalAccess(bool $bool)
Enable PDF for Universal Access for optimal accessibility.

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhook(array $webhook)
> [!TIP]
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhookErrorRoute(string $route, array $parameters, ?string $method)
> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhookErrorUrl(string $url, ?string $method)
Sets the webhook for cases of success.<br />Optionally sets a custom HTTP method for such endpoint among : POST, PUT or PATCH.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhookExtraHeaders(array $extraHttpHeaders)
Extra headers that will be provided to the webhook endpoint. May it either be Success or Error.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhookRoute(string $route, array $parameters, ?string $method)
> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

### webhookUrl(string $url, ?string $method)
Sets the webhook for cases of success.<br />Optionally sets a custom HTTP method for such endpoint among : POST, PUT or PATCH.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#merge-pdfs-route](https://gotenberg.dev/docs/routes#merge-pdfs-route)

