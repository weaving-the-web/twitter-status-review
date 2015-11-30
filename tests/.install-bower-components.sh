#!/bin/bash

test -e .bowerrc && rm .bowerrc

# Install test vendors
(cd tests && bower install)

# Install vendors
cp src/WeavingTheWeb/Bundle/DashboardBundle/Resources/{config/bower/bower.json,public/components}

echo '{"directory": "./"}' > .bowerrc
(cd src/WeavingTheWeb/Bundle/DashboardBundle/Resources/public/components && bower install)
