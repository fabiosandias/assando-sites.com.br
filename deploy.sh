#!/bin/sh

echo "Gerando CSS (LESS)"

lessc webroot/css/style.less -x > webroot/css/style.css
if [ "$?" -eq "0" ]; then
	c=$(ls -lah webroot/css/style.css | awk '{ print $5}')
	echo "style.less >> style.css - $c"
fi

lessc webroot/css/aluno.less -x > webroot/css/aluno.css
if [ "$?" -eq "0" ]; then
	c=$(ls -lah webroot/css/aluno.css | awk '{ print $5}')
	echo "aluno.less >> aluno.css - $c"
fi
