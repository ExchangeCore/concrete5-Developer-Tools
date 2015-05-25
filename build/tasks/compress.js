module.exports = {
    release: {
        options: {
            archive: 'ec_dev_tools.zip'
        },
        files: [
            {
                expand: true,
                cwd: "../../",
                src: [
                    "ec_dev_tools/**/*.*",
                    "!**/*.git*",
                    "!**/.baseDir.js",
                    "!ec_dev_tools/build/**/*",
                    "!ec_dev_tools/README.md"
                ]
            }
        ]
    }
};