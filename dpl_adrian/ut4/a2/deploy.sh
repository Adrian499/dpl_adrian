#!/bin/bash

# Variables
USER="dplprod_adrian"
HOST="100.76.80.23"
APP_DIR="/var/www/dpl_adrian/dpl_adrian"

echo "Conectando a $HOST y actualizando repositorio..."

ssh ${USER}@${HOST} << EOF
  set -e
  cd ${APP_DIR}
  git pull
  echo "Deploy completado correctamente"
EOF
