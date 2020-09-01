# gha-clover-test-coverage-check

A clover test coverage checker for Github Actions.

## Usage
Simply add the following step to your workflow:

```yml
- name: Check test coverage
  uses: johanvanhelden/clover-coverage-check@v1
  with:
    percentage: "95"
    filename: "coverage.xml"
```

### Percentage
The minimum percentage of coverage allowed.

### Filename 
The filename of the clover coverage XML file.

### Generating a coverage report
This is how you can generate a test coverage report using PHPUnit:

```yml
- name: Generate code coverage
  run: ./vendor/bin/phpunit --coverage-clover ./coverage.xml
```