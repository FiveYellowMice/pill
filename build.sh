#!/bin/sh

need_command() {
  command -v $1
  if [ $? != 0 ]; then
    echo "Command $1 is needed."
    exit 1
  fi
}

need_command bower

project_path="$(pwd)"

cd "$project_path"
echo "Complete!"
