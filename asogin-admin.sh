#!/bin/bash
export NVM_DIR=$HOME/.nvm;
source $NVM_DIR/nvm.sh;

directory=/home/tomas/dev/asogin-admin
browser=google-chrome
chatgpt_url='https://chatgpt.com/g/g-p-678ee2eda8e48191ba257bdaa83bad7d-asogin-admin/project'
linear_url='https://linear.app/asogin-admin/team/ASO/active'

function figma
{
  echo "figma"
}

function vs-code
{
  code $directory
}

function run
{
  case $1 in
    fe)
      cd $directory
      npm run dev
      ;;

    be)
      cd $directory
      php artisan serve
      ;;
  esac
}

function develop
{
  terminator -l asogin &
}

while getopts "cdeflr:" option; do
  case $option in     
    c)
      vs-code
      exit;;

    d) 
      develop
      vs-code
      exit;;

    e)
      code $directory/asogin-admin.sh
      exit;;

    f) 
      figma $OPTARG
      exit;;

    l)
      $browser $linear_url
      exit;;

    r)
      run $OPTARG
      exit;;

    \?) 
      echo "Error: invalid option"
      exit;;
  esac
done