#!/bin/bash

PRIVATE_KEY_PATH="/home/diogo/.ssh/PROD_DIOGO_PRIVATE_KEY.pem"
REMOTE_USER="diogo"
REMOTE_HOST="54.88.250.35"
REMOTE_PATH="/var/www/html/recommend"
SSH_PORT=2222

VERSION=$1

if [ -z "$VERSION" ]; then
  echo "Uso: ./deploy.sh v1.1"
  exit 1
fi

echo "🔹 Atualizando main..."

git checkout main
git pull origin main

echo "🔹 Merge release -> main..."
git merge release/$VERSION

echo "🔹 Criando tag..."
git tag $VERSION
git push origin main --tags

echo "🚀 Deploy em PRODUÇÃO ($VERSION)..."

ssh -i "$PRIVATE_KEY_PATH" -p $SSH_PORT $REMOTE_USER@$REMOTE_HOST "
  cd $REMOTE_PATH &&
  sudo git config --global user.name 'Diogo Bezerra' &&
  sudo git config --global user.email 'diogobezerra5@gmail.com' &&
  sudo git config --global --add safe.directory $REMOTE_PATH &&
  sudo git fetch --all --tags &&
  sudo git reset --hard $VERSION &&
  sudo chown -R diogo:www-data $REMOTE_PATH &&
  sudo chmod -R 770 $REMOTE_PATH
"

echo "✅ Deploy em produção concluído!"