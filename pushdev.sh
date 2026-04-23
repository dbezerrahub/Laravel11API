#!/bin/bash
branch=$(git branch --show-current)
commit="${1:-update}"

git checkout dev
git merge $branch
git push
git checkout $branch

#npm run android
