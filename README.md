# dependency-injection-examples
To launch the container:

```docker compose up -d --build```

To rebuild it after a Docker change:

```docker compose up -d --build --remove-orphans```

To connect to the container (using bash)

```docker exec -it dependency-injection-examples-core-1 /bin/bash```

## Tests
To run tests (when connected to the container)

```composer install``` (first time only)

```composer test```

### Code Coverage

```composer test -- --coverage-html coverage```

To view, open  `<app-folder>/coverage/index.html` in a browser.

