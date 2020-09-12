# gha-clover-test-coverage-check

A clover test coverage checker for Github Actions.

## Usage
Simply add the following step to your workflow:

```yml
- name: Check test coverage
  id: test-coverage
  uses: johanvanhelden/gha-clover-test-coverage-check@v1
  with:
    percentage: "95"
    filename: "coverage.xml"
```

## Input

### percentage
The minimum percentage of coverage allowed.

### filename 
The filename of the clover coverage XML file.

### rounded-precision (optional)
The precision of the rounded coverage value. Where `0` will round to the highest rounded number (e.g: `99.999999` > `100`).

### exit (optional)
Wether the coverage check should exit if the required percentage is not met.

## Output
Output is exported as [GitHub Action output](https://docs.github.com/en/actions/reference/context-and-expression-syntax-for-github-actions#steps-context).

You can use it in other steps, for example:
```yml
- name: Test coverage
  run: echo "${{ steps.test-coverage.outputs.coverage }}"
```

Or make a step conditional:
```yml
- name: Test coverage report
  if: steps.test-coverage.outputs.coverage > 50
  run: echo "We are more than halfway there!"
```

### coverage
The calculated coverage value.

### coverage-display
The calculated coverage value for display purposes.

### coverage-rounded
The rounded coverage value.

### coverage-rounded-display
The rounded calculated coverage value for display purposes.

### coverage-acceptable
The true or false value of the check result.
You can use this output with the `exit` input to implement your own coverage logic.

### Generating a coverage report
This is how you can generate a test coverage report using PHPUnit:

```yml
- name: Generate code coverage
  run: ./vendor/bin/phpunit --coverage-clover ./coverage.xml
```

## Action Development
You can test the action locally by running: `docker-compose up --build`
Any arguments can be configured in the `docker-compose.yml` file.

## Building and publishing

Building happens automaticly once a new version is tagged.

To push a manual build, ensure you are logged in locally to hub.docker.com using `docker login` and have access to the hub repository.
(note: your username is used, not your email address).

```
$ docker build ./ --tag johanvanhelden/gha-clover-test-coverage-check:TAG
$ docker push johanvanhelden/gha-clover-test-coverage-check:TAG
```

Replace `TAG` with the tag you are working on.
