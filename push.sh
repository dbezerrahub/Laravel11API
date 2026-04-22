#!/bin/bash 
branch=$(git branch --show-current)
commit="${1:-update}"

git add .
git commit -m "$commit" || echo "⚠️ Nenhuma alteração para commitar"
git push -u origin "$branch" || exit 1

# Obs: 
# No caso de mais de um desenvolvedor deve-se mandar pra dev (pushdev.sh) somente 
# quando a feature ou correção estiver pronta, revisada e autorizada
# Como estou desenvolvendo sozinho aqui dou push direto pra dev pra não ter que executar 
# também pushdev.sh. 
# dev tem que estar sempre atualizada pois é de onde são criadas novas branches de desenvolvimento
git checkout dev 
git merge $branch
git push
git checkout $branch 