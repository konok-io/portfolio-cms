/**
 * Asset Minification Script
 * 
 * Usage:
 * 1. Install dependencies: npm install clean-css-cli uglify-js
 * 2. Run: node scripts/minify-assets.js
 * 
 * Or use with Laravel Mix (recommended):
 * 1. Install Laravel Mix: npm install laravel-mix
 * 2. Create webpack.mix.js
 * 3. Run: npm run prod
 */

const fs = require('fs');
const path = require('path');

// For CSS minification (requires clean-css-cli)
// npm install --save-dev clean-css-cli
let CleanCSS;
try {
    CleanCSS = require('clean-css');
} catch (e) {
    console.log('Note: Install clean-css for CSS minification: npm install clean-css');
}

// For JS minification (requires uglify-js)
// npm install --save-dev uglify-js
let UglifyJS;
try {
    UglifyJS = require('uglify-js');
} catch (e) {
    console.log('Note: Install uglify-js for JS minification: npm install uglify-js');
}

const assetsDir = path.join(__dirname, '../public/assets');
const cssDir = path.join(assetsDir, 'css');
const jsDir = path.join(assetsDir, 'js');

function minifyCSS(inputFile, outputFile) {
    if (!CleanCSS) {
        console.log('Skipping CSS minification (clean-css not installed)');
        return false;
    }
    
    try {
        const inputPath = path.join(cssDir, inputFile);
        const outputPath = path.join(cssDir, outputFile);
        
        const input = fs.readFileSync(inputPath, 'utf8');
        const output = new CleanCSS({}).minify(input);
        
        fs.writeFileSync(outputPath, output.styles);
        
        const originalSize = Buffer.byteLength(input, 'utf8');
        const minifiedSize = Buffer.byteLength(output.styles, 'utf8');
        const savings = ((1 - minifiedSize / originalSize) * 100).toFixed(1);
        
        console.log('CSS: ' + inputFile + ' -> ' + outputFile + ' (' + savings + '% smaller)');
        return true;
    } catch (error) {
        console.error('CSS Error: ' + error.message);
        return false;
    }
}

function minifyJS(inputFile, outputFile) {
    if (!UglifyJS) {
        console.log('Skipping JS minification (uglify-js not installed)');
        return false;
    }
    
    try {
        const inputPath = path.join(jsDir, inputFile);
        const outputPath = path.join(jsDir, outputFile);
        
        const input = fs.readFileSync(inputPath, 'utf8');
        const result = UglifyJS.minify(input);
        
        if (result.error) {
            throw result.error;
        }
        
        fs.writeFileSync(outputPath, result.code);
        
        const originalSize = Buffer.byteLength(input, 'utf8');
        const minifiedSize = Buffer.byteLength(result.code, 'utf8');
        const savings = ((1 - minifiedSize / originalSize) * 100).toFixed(1);
        
        console.log('JS: ' + inputFile + ' -> ' + outputFile + ' (' + savings + '% smaller)');
        return true;
    } catch (error) {
        console.error('JS Error: ' + error.message);
        return false;
    }
}

console.log('\nAsset Minification Script');
console.log('========================\n');

// Minify CSS files
console.log('CSS Files:');
minifyCSS('front.css', 'front.min.css');
minifyCSS('admin.css', 'admin.min.css');

// Minify JS files
console.log('\nJS Files:');
minifyJS('front.js', 'front.min.js');
minifyJS('admin.js', 'admin.min.js');

console.log('\nMinification complete!\n');
console.log('Next steps:');
console.log('1. Update your layout to use .min.css and .min.js files in production');
console.log('2. Or use Laravel Mix/Vite for automatic asset compilation\n');
