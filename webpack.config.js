const path = require('path');
const fs = require('fs');
const glob = require('glob');

let config = {
    // TODO: Add common Configuration
    module: {},
    mode: 'production'
};

function getDirectories(srcPath) {
    return fs.readdirSync(srcPath).filter(function (file) {
        return fs.statSync(path.join(srcPath, file)).isDirectory();
    });
}

let componentsJsBackend = getDirectories('./public/js/backend/webpack');
let componentsCssBackend = getDirectories('./public/css/backend/webpack');
let componentsJsFrontend = getDirectories('./public/js/frontend/webpack');
let componentsCssFrontend = getDirectories('./public/css/frontend/webpack');

let configs = [];
let componentsBackend = arrayUnique(componentsJsBackend.concat(componentsCssBackend));
let componentsFrontend = arrayUnique(componentsJsFrontend.concat(componentsCssFrontend));

for (let i = 0; i < componentsBackend.length; i++) {
    let componentsCss = glob.sync('./public/css/backend/webpack/' + componentsBackend[i] +'/*.{css,scss}*');

    let configObject = Object.assign({}, config, {
        entry: toArray(glob.sync('./public/js/backend/webpack/' + componentsBackend[i] +'/*.js*').concat(componentsCss)),
        output: {
            path: path.resolve(__dirname, 'public/js/backend/webpack'),
            filename: componentsBackend[i] + '.js'
        },
        watch: true,
        module: {
            rules: [
                {
                    test: /\.scss$/,
                    use: [
                        "style-loader", // creates style nodes from JS strings
                        "css-loader", // translates CSS into CommonJS
                        "sass-loader" // compiles Sass to CSS
                    ]
                },
                {
                    test: /\.css$/,
                    use: [
                        'style-loader',
                        'css-loader'
                    ]
                }
            ]
        }
    });

    configs.push(configObject);
}

for (let i = 0; i < componentsFrontend.length; i++) {
    let componentsCss = glob.sync('./public/css/frontend/webpack/' + componentsFrontend[i] +'/*.{css,scss}*');

    let configObject = Object.assign({}, config, {
        entry: toArray(glob.sync('./public/js/frontend/webpack/' + componentsJsFrontend[i] +'/*.js*').concat(componentsCss)),
        output: {
            path: path.resolve(__dirname, 'public/js/frontend/webpack'),
            filename: componentsJsFrontend[i] + '.js'
        },
        watch: true,
        module: {
            rules: [
                {
                    test: /\.scss$/,
                    use: [
                        "style-loader", // creates style nodes from JS strings
                        "css-loader", // translates CSS into CommonJS
                        "sass-loader" // compiles Sass to CSS
                    ]
                },
                {
                    test: /\.css$/,
                    use: [
                        'style-loader',
                        'css-loader'
                    ]
                }
            ]
        }
    });

    configs.push(configObject);

}

function toArray(paths) {
    let ret = [];
    paths.forEach(function(path) {
        ret.push(path);
    });
    return ret;
}

function arrayUnique(array) {
    let a = array.concat();
    for(let i=0; i<a.length; ++i) {
        for(let j=i+1; j<a.length; ++j) {
            if(a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
}

module.exports = configs;