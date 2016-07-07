'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    compass: {                  // Task
    	dist: {                   // Target
			options: {              // Target options
				sassDir: 'sass',
				cssDir: 'assets/css',
				imagesDir: 'img',
				fontsDir: 'fonts',
				environment: 'production',
				outputStyle: 'compressed',
				force: true
			}
		},
		dev: {                    // Another target
			options: {
				sassDir: 'sass',
				cssDir: 'assets/css',
				imagesDir: 'img',
				fontsDir: 'fonts',
				environment: 'development',
				outputStyle: 'expanded',
				sourcemap: false,
			}
		}
	},
    watch: {
      compass: {
		  files: ['sass/**/*.{scss,sass}'],
		  tasks: ['compass:dev']
	  },
    },
    
  });

  // Load tasks
  
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');

  // Register tasks
  grunt.registerTask('default', [
    'compass:dist',
  ]);

  grunt.registerTask('dev', [
	'compass:dev',
    'watch'
  ]);

};
