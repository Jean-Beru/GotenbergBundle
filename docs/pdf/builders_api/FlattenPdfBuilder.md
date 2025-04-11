# FlattenPdfBuilder

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### downloadFrom(array $downloadFrom)
Sets download from to download each entry (file) in parallel (URLs MUST return a Content-Disposition header with a filename parameter.).<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/routes#download-from](https://gotenberg.dev/docs/routes#download-from)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### files(Stringable|string $paths)
### webhook(array $webhook)
> [!TIP]
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### webhookErrorRoute(string $route, array $parameters, ?string $method)
> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### webhookErrorUrl(string $url, ?string $method)
Sets the webhook for cases of success.<br />Optionally sets a custom HTTP method for such endpoint among : POST, PUT or PATCH.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### webhookExtraHeaders(array $extraHttpHeaders)
Extra headers that will be provided to the webhook endpoint. May it either be Success or Error.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### webhookRoute(string $route, array $parameters, ?string $method)
> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

### webhookUrl(string $url, ?string $method)
Sets the webhook for cases of success.<br />Optionally sets a custom HTTP method for such endpoint among : POST, PUT or PATCH.<br />

> [!TIP]
> See: [https://gotenberg.dev/docs/webhook](https://gotenberg.dev/docs/webhook)<br />
> See: [https://gotenberg.dev/docs/routes#flatten-pdfs-route](https://gotenberg.dev/docs/routes#flatten-pdfs-route)

