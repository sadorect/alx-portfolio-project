#!/bin/bash

echo "# alx-portfolio-project" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/sadorect/alx-portfolio-project.git
git push -u origin main
