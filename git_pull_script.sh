
#!/bin/bash

if [ ! -d .git  ]; then
echo "repozitorijs ir cita vieta!"
exit 1
fi

# veic atjauninajumu
echo "novelkam atjauninajumu ar git pull"
git pull

#izvēlamies repo kuru gribam iegut
SCRIPT="README.md"

# Pārbauda, vai eksistē fails
 if [ -f "$SCRIPT" ]; then
  echo "Fails '$SCRIPT' atrasts repo"
  # Ja vēlies iegūt šo failu no repozitorija, vari izmantot git checkout (ja tas ir nepieciešams)
  git checkout "$SCRIPT"
else
  echo "Fails '$SCRIPT' netika atrasts repozitorijā."
fi

echo "Skripts 'git_pull_script.sh' izpildits."

