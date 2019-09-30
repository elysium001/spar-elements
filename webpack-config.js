const path = require( 'path' );
const CopyPlugin = require('copy-webpack-plugin');

const config = {
	entry: {
		spar_carousel: './elements/carousel/spar-carousel.js'
	},

	output: {
		filename: 'js/[name].js',
		path: path.resolve( __dirname, 'assets' )
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader'
			}
		]
	},
	
	plugins: [
		new CopyPlugin([
		  { from: 'node_modules/bootstrap/dist', to: 'libraries/bootstrap/dist' },
		  { from: 'node_modules/owl.carousel/dist', to: 'libraries/owl.carousel/dist' },
		]),
	],
}

module.exports = config;