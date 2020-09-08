# gha-clover-test-coverage-check

A clover test coverage checker for Github Actions.

## Usage
Simply add the following step to your workflow:

```yml
- name: Check test coverage
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

## Output

### coverage
The calculated value is exported as a [GitHub Action output](https://docs.github.com/en/actions/reference/context-and-expression-syntax-for-github-actions#steps-context) as `coverage`. For example: `${{ steps.coverage.outputs.coverage }}`.

### Generating a coverage report
This is how you can generate a test coverage report using PHPUnit:

```yml
- name: Generate code coverage
  run: ./vendor/bin/phpunit --coverage-clover ./coverage.xml
```
