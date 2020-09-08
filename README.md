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
The calculated value.

### Generating a coverage report
This is how you can generate a test coverage report using PHPUnit:

```yml
- name: Generate code coverage
  run: ./vendor/bin/phpunit --coverage-clover ./coverage.xml
```
