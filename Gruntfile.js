module.exports = function(grunt) {
  grunt.initConfig({
    compass: {
	    compile: {
        options: {
          sassDir: 'edison/public/scss',
          cssDir: 'edison/public/css',
          specify: 'edison/public/scss/*.scss'
        }
      }
    },

    sass: {
      options: {
        style: 'compressed'
      },
      files: {
        expand: true,
        flatten: true,
        src: ['edison/public/scss/*.scss'],
        dest: 'edison/public/css/',
        ext: '.css'
      }  
    },

    coffee: {
      files: {
          //'edison/public/dev-js/*.js': ['edison/public/coffee/*.coffee']
          expand: true,
          flatten: true,
          src: ['edison/public/coffee/*.coffee'],
          dest: 'edison/public/dev-js/',
          ext: '.js'
        }
      },

    uglify: {
      my_target: {
        files: {
          'edison/public/js/app.min.js': ['edison/public/dev-js/*.js']
        }
      }
    },

    watch: {
      stylesheets: {
        files: ['edison/public/scss/*.scss'],
        tasks: ['compass']
      },

      coffeescript: {
        files: ['edison/public/coffee/*.coffee'],
        tasks: ['coffee', 'uglify']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-coffee');  
  grunt.loadNpmTasks('grunt-contrib-uglify');

};