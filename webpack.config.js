import path from 'path';

export default {
    // Multiple entry points
    entry: {
        login: './assets/js/User/login.js',      // Entry for login module
        // register: './assets/js/User/register.js', // Entry for register module
        // dashboard: './assets/js/Admin/dashboard.js', // Entry for admin dashboard
        // settings: './JS/Admin/settings.js',   // Entry for admin settings
    },
    // Output settings
    output: {
        filename: '[name].bundle.js', // Generate bundles based on entry names (e.g., login.bundle.js)
        path: path.resolve(process.cwd(), 'dist'), // Output directory
        clean: true, // Clean output directory before building
    },
    // Module rules for processing files
    module: {
        rules: [
            {
                test: /\.js$/, // Transpile JavaScript
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: /\.css$/, // Handle CSS files
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
    // Set mode
    mode: 'development', // Change to 'production' for optimized builds
    watch: true, // Automatically watch for changes
};
