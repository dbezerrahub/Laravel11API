#!/bin/bash 

PRIVATE_KEY_PATH="/home/diogo/.ssh/PROD_DIOGO_PRIVATE_KEY.pem"
REMOTE_USER="diogo"
REMOTE_HOST="54.88.250.35"
REMOTE_PATH="/var/www/html/recommend"
SSH_PORT=2222

VERSION=$1

if [ -z "$VERSION" ]; then
  echo "Uso: ./release.sh v1.1"
  exit 1
fi

# 🔹 Evita versão duplicada
if git rev-parse "$VERSION" >/dev/null 2>&1; then
  echo "❌ Tag $VERSION já existe!"
  exit 1
fi

echo "🔹 Atualizando dev..."
git checkout dev
git pull origin dev

echo "🔹 Criando release/$VERSION..."
git checkout -b release/$VERSION
git push -u origin release/$VERSION

git checkout dev

echo "🚀 Deploy em HOMOLOGAÇÃO (release/$VERSION)..."

ssh -i "$PRIVATE_KEY_PATH" -p $SSH_PORT $REMOTE_USER@$REMOTE_HOST "
  cd $REMOTE_PATH &&
  sudo git config --global user.name 'Diogo Bezerra' &&
  sudo git config --global user.email 'diogobezerra5@gmail.com' &&
  sudo git config --global --add safe.directory $REMOTE_PATH &&
  sudo git fetch origin &&
  sudo git checkout release/$VERSION || sudo git checkout -b release/$VERSION origin/release/$VERSION &&
  sudo git reset --hard origin/release/$VERSION &&
  sudo chown -R diogo:www-data $REMOTE_PATH &&
  sudo chmod -R 770 $REMOTE_PATH
"

echo "✅ Release $VERSION enviada para HOMOL!"