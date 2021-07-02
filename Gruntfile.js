'use strict';
module.exports = function (grunt) {

	grunt.initConfig({
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/src/js/**/*.js',
				'!assets/js/app.min.js'
			]
		},
		sass: {
			dist: {
				options: {
					style: 'compressed',
					compass: false,
					sourcemap: false
				},
				files: {
					'assets/css/style.min.css': [
						'assets/src/scss/style.scss'
					]
				}
			}
		},
		uglify: {
			dist: {
				files: {
					'assets/js/app.min.js': [
						'assets/src/js/app.js'
					]
				},
				options: {
					sourceMap: 'assets/js/app.min.js.map',
					sourceMappingURL: '/assets/src/app.min.js.map'
				}
			}
		},
		watch: {
			sass: {
				files: [
					'assets/src/scss/**/*.scss'
				],
				tasks: ['sass'],
				options: {
					livereload: true
				}
			},
			js: {
				files: [
					'assets/js/**/*.js'
				],
				tasks: ['jshint', 'uglify']
			},
			html: {
				files: [
					'**/*.html'
				]
			}
		},
		clean: {
			dist: [
				'assets/style.min.css',
				'assets/javascript.min.js'
			]
		}
	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');

	// Register tasks
	grunt.registerTask('default', [
		'clean',
		'sass',
		'uglify'
	]);
	grunt.registerTask('dev', [
		'watch'
	]);

};