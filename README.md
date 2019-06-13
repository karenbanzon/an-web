# Accountable Now web project

This is the repository for the Accountable Now website

## Prerequisites
Make sure you have `docker` and `docker-compose`. If you want to update the theme and will need to update the styles, you need `npm`.

## Running the project
To spin up the development environment, run this command in the root of the project
```
make start-devenv
```

If you want to simulate the production environment, run this command:
```
make-start-prod
```

## Making changes to the theme
This project uses [Tailwindcss](https://tailwindcss.com).

To rebuild the styles for this project, you need to first navigate to the theme directory
```
cd wp-content/themes/an-theme/
```

Then you must install the required node modules
```
npm install
```

To regenerate the styles, you need to call Tailwind using `npx`
```
npx tailwind build styles/main.css -c tailwind.js -o styles/style.css
```