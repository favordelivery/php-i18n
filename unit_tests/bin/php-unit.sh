#!/bin/sh

cd /var/app

# cp .env.example .env
# cp -R /var/app/vendor/ vendor/


unitTest()
{
  vendor/phpunit/phpunit/phpunit \
    -c /var/app/tests/phpunit.xml \
        --testsuite=Unit \
        --log-junit=tests/results/unit/phpunit-test-results.xml
  unitTestExitCode=$?
  return 0
}

echo "-------------"
echo "Running Unit Tests"
unitTest
echo "Exited $unitTestExitCode"
echo "-------------"

if [[ $unitTestExitCode != 0 ]]; then
  echo "Automated tests failed"
  exit 1
else
  echo "Automated tests succeeded!"
fi