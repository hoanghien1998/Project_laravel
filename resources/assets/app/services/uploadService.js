import _ from 'lodash';
import axios from 'axios';

/**
 * @typedef {Object} UploadFileToS3Data
 * @property {string} upload_url - Presigned URL to use for PUT file upload
 * @property {string} url - URL, that uploded file will have after upload to S3
 * @property {Date} valid_until - Time, after which upload_url cannot be used
 *
 * Use:
 *    import uploadService from "./services/uploadService";
 *    const uploadRequest = uploadService.uploadTmp(file.name, file);
 */

/**
 * Function for image uploading.
 */
export default {
  $imageExtensions: [
    'jpg',
    'jpeg',
    'png',
    'bmp',
    'gif',
  ],

  /**
   * Check image extension by name.
   *
   * @param {string} name - Image name.
   *
   * @return boolean
   */
  checkImageExtension(name) {
    const extension = _.last(name.split('.'));

    if (extension && _.includes(this.$imageExtensions, extension.toLowerCase())) {
      return true;
    }
    throw new Error(`Image must be one of types: ${this.$imageExtensions.join(', ')}`);
  },

  /**
   * Get presigned url for upload temporary file on S3.
   * File will be saved with unique random name in /tmp folder and this name will be returned.
   *
   * @param {string} fileName - Original file name to upload on S3.
   *
   * @return {UploadFileToS3Data}
   */
  async preSignTmpUpload(fileName) {
    const uploadFileToS3Data = (await axios.post('/api/uploads/tmp', { fileName })).data;

    if (!uploadFileToS3Data.upload_url || !uploadFileToS3Data.url) {
      throw new Error('Could not get presigned URL for image upload');
    }

    return uploadFileToS3Data;
  },

  /**
   * Upload image, using UploadFileToS3Data API response
   *
   * @param {Blob} image Image binary data
   * @param {UploadFileToS3Data} preSigned UploadFileToS3Data
   * @return {Promise<*>}
   */
  async preSignedUpload(image, preSigned) {
    try {
      await axios.put(preSigned.upload_url, image, {
        headers: { 'Content-Type': image.type },
      });

      return preSigned.url;
    } catch (error) {
      throw new Error('Could not upload file to server');
    }
  },

  /**
   * Upload file to temporary folder on S3 with generated name and return url
   *
   * @param {string} name - File name.
   * @param {Blob} file - Blob file content
   *
   * @return string
   */
  async uploadTmp(name, file) {
    return this.preSignedUpload(file, await this.preSignTmpUpload(name));
  },
};
